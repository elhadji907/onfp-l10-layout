<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArriveStoreRequest;
use App\Models\Arrive;
use App\Models\Courrier;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ArriveController extends Controller
{
    public function index()
    {
        $arrives = Arrive::orderBy('created_at', 'desc')->get();
        return view("courriers.arrives.index", compact("arrives"));
    }

    public function create()
    {
        $anneeEnCours = date('Y');
        $numCourrier = Arrive::get()->last();
        if (isset($numCourrier)) {
            $numCourrier = Courrier::get()->last()->numero;
                $numCourrier = ++$numCourrier;
           
        } else {
            $numCourrier = "000001";

        }

        $longueur = strlen($numCourrier);

        if ($longueur <= 1) {
            $numCourrier   =   strtolower("00000".$numCourrier);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numCourrier   =   strtolower("0000".$numCourrier);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numCourrier   =   strtolower("000".$numCourrier);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numCourrier   =   strtolower("00".$numCourrier);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numCourrier   =   strtolower("0".$numCourrier);
        } else {
            $numCourrier   =   strtolower($numCourrier);
        }
        return view("courriers.arrives.create", compact('anneeEnCours', 'numCourrier'));
    }

    public function store(ArriveStoreRequest $request): RedirectResponse
    {
        $courrier = new Courrier([
            'date_recep'            =>      $request->input('date_arrivee'),
            'date_cores'            =>      $request->input('date_correspondance'),
            'numero'                =>      $request->input('numero_correspondance'),
            'annee'                 =>      $request->input('annee'),
            'objet'                 =>      $request->input('objet'),
            'expediteur'            =>      $request->input('expediteur'),
            'reference'             =>      $request->input('reference'),
            'numero_reponse'        =>      $request->input('numero_reponse'),
            'date_reponse'          =>      $request->input('date_reponse'),
            'observation'           =>      $request->input('observation'),
            'type'                  =>      'arrive',
            "user_create_id"        =>      Auth::user()->id,
            "user_update_id"        =>      Auth::user()->id,
            'users_id'              =>      Auth::user()->id,
        ]);

        $courrier->save();

        $arrive = new Arrive([
            'numero'             =>      $request->input('numero_correspondance'),
            'courriers_id'       =>      $courrier->id
        ]);

        $arrive->save();

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }


    public function edit($id)
    {
        $arrive = Arrive::findOrFail($id);
        return view("courriers.arrives.update", compact("arrive"));
    }

    public function update(Request $request, $id)
    {
        $arrive = Arrive::findOrFail($id);
        $courrier = Courrier::findOrFail($arrive->courriers_id);

        $imp = $request->input('imp');

        if (isset($imp) && $imp == "1") {            
            $courrier = $arrive->courrier;
            /* $count = count($request->product); */
            $courrier->directions()->sync($request->id_direction);
            $courrier->employees()->sync($request->id_employe);
            $courrier->description =  $request->input('description');
            $courrier->date_imp    =  $request->input('date_imp');
            $courrier->save();
            
            $status = 'Courrier imputé avec succès';

            return Redirect::route('arrives.index')->with('status', $status);

            //solution, récuper l'id à partir de blade avec le mode hidden
        }

        $this->validate($request, [
            "date_arrivee"          => ["required", "date"],
            "date_correspondance"   => ["required", "date"],
            "numero_correspondance" => ["required", "string", "min:4", "max:6", "unique:arrives,numero,Null,id,deleted_at,NULL" . $arrive->id],
            "annee"                 => ["required", "string"],
            "expediteur"            => ["required", "string"],
            "objet"                 => ["required", "string"],

            "numero_reponse"        => ["string", "min:4", "max:6", "nullable", "unique:courriers,numero_reponse,Null,id,deleted_at,NULL" . $courrier->id],
            "date_reponse"          => ["nullable", "date"],
            "observation"           => ["nullable", "string"],
        ]);

        $courrier->update(
            [
                'date_recep'       =>      $request->input('date_arrivee'),
                'date_cores'       =>      $request->input('date_correspondance'),
                'numero'           =>      $request->input('numero_correspondance'),
                'annee'            =>      $request->input('annee'),
                'objet'            =>      $request->input('objet'),
                'expediteur'       =>      $request->input('expediteur'),
                'reference'        =>      $request->input('reference'),
                'numero_reponse'   =>      $request->input('numero_reponse'),
                'date_reponse'     =>      $request->input('date_reponse'),
                'observation'      =>      $request->input('observation'),
                'type'             =>      'arrive',
                "user_create_id"   =>      Auth::user()->id,
                "user_update_id"   =>      Auth::user()->id,
                'users_id'         =>      Auth::user()->id,
            ]
        );

        $arrive->update(
            [
                'numero'             =>      $request->input('numero_correspondance'),
                'courriers_id'       =>      $courrier->id,
            ]
        );

        $status = 'Mise à jour effectuée avec succès';

        return Redirect::route('arrives.index')->with('status', $status);
    }
    public function show($id)
    {
        $arrive = Arrive::findOrFail($id);

        $courrier = Courrier::findOrFail($arrive->courriers_id);

        $user_create = User::find($courrier->user_create_id);
        $user_update = User::find($courrier->user_update_id);

        $user_create_name = $user_create->firstname . ' ' . $user_create->name;
        $user_update_name = $user_update->firstname . ' ' . $user_update->name;

        return view("courriers.arrives.show", compact("arrive", "courrier", "user_create_name", "user_update_name"));
    }

    public function destroy($arriveId)
    {
        $arrive = Arrive::findOrFail($arriveId);
        $arrive->courrier()->delete();
        $arrive->delete();
        $status = "Supprimer avec succès";
        return redirect()->back()->with("danger", $status);
    }

    public function arriveImputation(Request $request, $id)
    {
        $arrive = Arrive::findOrFail($id);
        $courrier = $arrive->courrier;

        return view("courriers.arrives.imputation-arrive", compact("arrive", "courrier"));
    }

    function fetch(Request $request)
    {

        if ($request->get('query')) {
            $query = $request->get('query');

            $data = DB::table('directions')
                ->where('sigle', 'LIKE', "%{$query}%")
                ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $direction) {
                $id = $direction->id;
                $sigle = $direction->sigle;
                $employe_id = $direction->chef_id;
                $employe = Employee::find($employe_id);

                $user = User::find($employe->users_id);

                $name = $user->firstname . ' ' . $user->name;

                $output .= '
       
                <li data-id="' . $id . '" data-chef="' . $name . '" data-employeid="' . $employe->id . '"><a href="#">' . $sigle . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function couponArrive($id)
    {
        $arrive = Arrive::find($id);
        $courrier = $arrive->courrier;

       /*  $directions     = Direction::pluck('sigle', 'id'); */
        
        $directions = Direction::pluck('sigle', 'sigle')->all();
        
        $arriveDirections = $courrier->directions->pluck('sigle', 'sigle')->all();
        
        $numero = $courrier->numero;
      
        $title =' Coupon d\'envoi n° '.$numero;

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);

        $actions = [
            'Urgent',
            'M\'en parler',
            'Etudes et Avis',
            'Répondre',
            'Suivi',
            'Information',
            'Diffusion',
            'Attribution',
            'Classement',
            ];

        $dompdf->loadHtml(view('courriers.arrives.arrive-coupon', compact(
            'arrive',
            'courrier',
            'directions',
            'arriveDirections',
            'title',
            'actions'
        )));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $anne = date('d');
        $anne = $anne.' '.date('m');
        $anne = $anne.' '.date('Y');
        $anne = $anne.' à '.date('H').'h';
        $anne = $anne.' '.date('i').'min';
        $anne = $anne.' '.date('s').'s';

        $name = $courrier->expediteur.', courrier arrivé n° '.$numero.' du '.$anne.'.pdf';

        // Output the generated PDF to Browser
        $dompdf->stream($name, ['Attachment' => false]);

    }
}
