<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartStoreRequest;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartController extends Controller
{
    
    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin|Courrier']);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }
    public function index()
    {
        $departs = Depart::orderBy('created_at', 'desc')->get();
        return view("courriers.departs.index", compact("departs"));
    }
    public function create()
    {
        $anneeEnCours = date('Y');
        $numCourrier = Depart::get()->last();
        if (isset($numCourrier)) {
            $numCourrier = Depart::get()->last()->numero;
            $numCourrier = ++$numCourrier;
        } else {
            $numCourrier = "0001";
        }

        $longueur = strlen($numCourrier);

        if ($longueur <= 1) {
            $numCourrier   =   strtolower("000" . $numCourrier);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numCourrier   =   strtolower("00" . $numCourrier);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numCourrier   =   strtolower("0" . $numCourrier);
        } else {
            $numCourrier   =   strtolower($numCourrier);
        }
        return view("courriers.departs.create", compact('anneeEnCours', 'numCourrier'));
    }
    public function store(DepartStoreRequest $request): RedirectResponse
    {
        $courrier = new Courrier([
            'date_depart'        =>      $request->input('date_depart'),
            'numero'             =>      $request->input('numero_correspondance'),
            'date_cores'         =>      $request->input('date_corres'),
            'annee'              =>      $request->input('annee'),
            'objet'              =>      $request->input('objet'),
            'numero_reponse'     =>      $request->input('numero_reponse'),
            'date_reponse'       =>      $request->input('date_reponse'),
            'observation'        =>      $request->input('observation'),
            'reference'          =>      $request->input('service_expediteur'),
            'type'               =>      'depart',
            "user_create_id"     =>      Auth::user()->id,
            "user_update_id"     =>      Auth::user()->id,
            'users_id'           =>      Auth::user()->id

        ]);

        $courrier->save();

        $depart = new Depart([
            'numero'             =>      $request->input('numero_depart'),
            'destinataire'       =>      $request->input('destinataire'),
            'courriers_id'       =>      $courrier->id

        ]);

        $depart->save();

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }


    public function edit($id)
    {
        $depart = Depart::findOrFail($id);
        return view("courriers.departs.update", compact("depart"));
    }

    public function update(Request $request, $id)
    {
        $depart = Depart::findOrFail($id);
        $courrier = Courrier::findOrFail($depart->courriers_id);

        $imp = $request->input('imp');

        if (isset($imp) && $imp == "1") {
            $courrier = $depart->courrier;
            /* $count = count($request->product); */
            $courrier->directions()->sync($request->id_direction);
            $courrier->employees()->sync($request->id_employe);
            $courrier->description =  $request->input('description');
            $courrier->date_imp    =  $request->input('date_imp');
            $courrier->save();

            $status = 'Courrier imputé avec succès';

            return Redirect::route('departs.index')->with('status', $status);

            //solution, récuper l'id à partir de blade avec le mode hidden
        }

        $this->validate($request, [
            "date_depart"           => ["required", "date"],
            "date_corres"           => ["required", "date"],
            "numero_correspondance" => ["required", "string", "min:4", "max:6", "unique:courriers,numero,Null,id,deleted_at,NULL" . $depart->courrier->id],
            "numero_depart"         => ["required", "string", "min:4", "max:6", "unique:departs,numero,Null,id,deleted_at,NULL" . $depart->id],
            "annee"                 => ["required", "string"],
            "objet"                 => ["required", "string"],
            "destinataire"          => ["required", "string"],
            "numero_reponse"        => ["string", "min:4", "max:6", "nullable", "unique:courriers,numero_reponse,Null,id,deleted_at,NULL" . $courrier->id],
            "date_reponse"          => ["nullable", "date"],
            "observation"           => ["nullable", "string"],
            "reference"             => ["nullable", "string"],
        ]);

        if (isset($courrier->file)) {
            $this->validate($request, [
                "legende"          => ["required", "string"],
            ]);
        }

        if (request('file')) {
            $this->validate($request, [
                "legende"          => ["required", "string"],
            ]);
            $filePath = request('file')->store('courriers', 'public');
            $courrier->update(
                [
                    'date_depart'        =>      $request->input('date_depart'),
                    'numero'             =>      $request->input('numero_correspondance'),
                    'date_cores'         =>      $request->input('date_corres'),
                    'annee'              =>      $request->input('annee'),
                    'objet'              =>      $request->input('objet'),
                    'numero_reponse'     =>      $request->input('numero_reponse'),
                    'date_reponse'       =>      $request->input('date_reponse'),
                    'observation'        =>      $request->input('observation'),
                    'reference'          =>      $request->input('service_expediteur'),
                    'file'               =>      $filePath,
                    'legende'            =>      $request->input('legende'),
                    'type'               =>      'depart',
                    "user_create_id"     =>      Auth::user()->id,
                    "user_update_id"     =>      Auth::user()->id,
                    'users_id'           =>      Auth::user()->id
                ]
            );
        } else {
            $courrier->update(
                [
                    'date_depart'        =>      $request->input('date_depart'),
                    'numero'             =>      $request->input('numero_correspondance'),
                    'date_cores'         =>      $request->input('date_corres'),
                    'annee'              =>      $request->input('annee'),
                    'objet'              =>      $request->input('objet'),
                    'numero_reponse'     =>      $request->input('numero_reponse'),
                    'date_reponse'       =>      $request->input('date_reponse'),
                    'observation'        =>      $request->input('observation'),
                    'reference'          =>      $request->input('service_expediteur'),
                    'legende'            =>      $request->input('legende'),
                    'type'               =>      'depart',
                    "user_create_id"     =>      Auth::user()->id,
                    "user_update_id"     =>      Auth::user()->id,
                    'users_id'           =>      Auth::user()->id
                ]
            );
        }
        $depart->update(
            [
                'numero'             =>      $request->input('numero_depart'),
                'destinataire'       =>      $request->input('destinataire'),
                'courriers_id'       =>      $courrier->id
            ]
        );

        $status = 'Courrier mis à jour effectuée avec succès';

        return Redirect::route('departs.index')->with('status', $status);
    }

    public function show($id)
    {
        $depart = Depart::findOrFail($id);

        $courrier = Courrier::findOrFail($depart->courriers_id);

        $user_create = User::find($courrier->user_create_id);
        $user_update = User::find($courrier->user_update_id);

        $user_create_name = $user_create->firstname . ' ' . $user_create->name;
        $user_update_name = $user_update->firstname . ' ' . $user_update->name;

        return view("courriers.departs.show", compact("depart", "courrier", "user_create_name", "user_update_name"));
    }
    public function destroy($departId)
    {
        $depart = Depart::findOrFail($departId);
        $depart->courrier()->delete();
        $depart->delete();
        $status = "courrier supprimer avec succès";
        return redirect()->back()->with("danger", $status);
    }


    public function departImputation(Request $request, $id)
    {
        $depart = Depart::findOrFail($id);
        $courrier = $depart->courrier;

        return view("courriers.departs.imputation-depart", compact("depart", "courrier"));
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
}
