<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class CourrierController extends Controller
{

    public function showFromNotification(Courrier $courrier, DatabaseNotification $notification)
    {

        $notification->markAsRead();

        /* $typescourrier = $courrier->types_courrier->name; */
        /* $arrive = $courrier->arrives; */
        $arrives = $courrier->arrives;
        $departs = $courrier->departs;
        foreach ($arrives as $key => $arrive) {
        }
        foreach ($departs as $key => $depart) {
        }
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;
        // $demandes = $courrier->demandeurs;

        /* $arrive = \App\Models\Arrive::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count(); */

        $user_create = User::find($courrier->user_create_id);
        $user_update = User::find($courrier->user_update_id);

        $user_create_name = $user_create->firstname . ' ' . $user_create->name;
        $user_update_name = $user_update->firstname . ' ' . $user_update->name;

        if ($courrier->type == 'arrive') {
            /* return view("courriers.arrives.show", compact("arrive", "courrier", "user_create_name", "user_update_name")); */
            return redirect()->back()->with('arrive', 'courrier', 'user_create_name', 'user_update_name');
        }

        if ($courrier->type == 'depart') {
            /* return view("courriers.departs.show", compact("depart", "courrier", "user_create_name", "user_update_name")); */
            return redirect()->back()->with('depart', 'courrier', 'user_create_name', 'user_update_name');
        }

        /*  if ($typescourrier == 'Courriers arrives') {            
            return view('arrives.show', compact('arrives','courrier'));
    
            } elseif($typescourrier == 'Courriers departs') {   
            return view('departs.show', compact('departs','courrier'));
    
            } elseif($typescourrier == 'Courriers internes') {    
                return view('internes.show', compact('internes','courrier'));
    
            }  
            elseif($typescourrier == 'Bordereau') {    
                return view('bordereaus.show', compact('bordereaus','courrier'));
    
            }  
            elseif($typescourrier == 'Factures daf') {    
                return view('facturesdafs.show', compact('facturesdafs','courrier'));
    
            }  
            elseif($typescourrier == 'Tresors') {    
                return view('tresors.show', compact('tresors','courrier'));
    
            }  elseif($typescourrier == 'Banques') {    
                return view('banques.show', compact('banques','courrier'));
        
            }else {
                return view('courriers.show', compact('courrier'));
            } */
    }

    public function notifications()
    {
        return view("courriers.notifications");
    }
    
}
