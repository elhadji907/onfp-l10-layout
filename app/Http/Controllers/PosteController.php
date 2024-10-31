<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class PosteController extends Controller
{
    public function index()
    {
        $postes = Poste::orderBy("created_at", "desc")->get();
        return view('postes.index', compact('postes'));
    }
    public function store(Request $request)
    {
        $data = request()->validate([
            'name'      =>  ['required', 'string'],
            'legende'   =>  ['required', 'string'],
            'image'     => ['image', 'required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);

        $imagePath = request('image')->store('postes', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);

        $image->save();

        $poste = new Poste([
            'name'      => $data['name'],
            'legende'   => $data['legende'],
            'users_id'  => auth()->user()->id,
            'image'     => $imagePath
        ]);

        $poste->save();

        Alert::success("Poster !!!", "Félicitations");

        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'name'      =>  ['required', 'string'],
            'legende'   =>  ['required', 'string'],
            'image'     => ['image', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);

        $poste = Poste::findOrFail($id);

        if (request('image')) {
            $imagePath = request('image')->store('postes', 'public');

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);

            $image->save();
        } else {
            $imagePath = $poste->image;
        }

        $poste->update([
            'name'      => $data['name'],
            'legende'   => $data['legende'],
            'users_id'  => auth()->user()->id,
            'image'     => $imagePath
        ]);

        $poste->save();

        Alert::success("Modifier !!!", "Félicitations");

        return redirect()->back();
    }


    public function destroy($id)
    {

        $Poste   = Poste::find($id);

        $Poste->delete();

        Alert::success('Effectué !', 'post supprimé');

        return redirect()->back();
    }
}
