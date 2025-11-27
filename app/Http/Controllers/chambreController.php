<?php

namespace App\Http\Controllers;

use App\Models\chambres;
use App\Models\room_type;
use Illuminate\Http\Request;

class chambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chambres = chambres::all();
        $type_chambres= room_type::all();

        return view('dashboard.chambres.index', compact('chambres', 'type_chambres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_chambres= room_type::all();
        return view('dashboard.chambres.create', compact('type_chambres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero_chambre' => 'required|unique:chambres,numero_chambre',
            'titre_chambre' => 'required',
            'description' => 'nullable',
            'capacite_chambre' => 'required|integer',
            'statut' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gal_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gal_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_chambre' => 'required',
            'prix_chambre' => 'required|numeric',
            'status' => 'boolean',
        ]);

        //dd($validatedData);
        // Gestion des l'images

        // image principale
        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imageChambre', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        } else {
            dd('Aucun fichier image reçu');
        }
        // img galeries 1 - 2
        if ($request->hasFile('gal_1')) {
            $filename1 = time().$request->file('gal_1')->getClientOriginalName();
            $path1 = $request->file('gal_1')->storeAs('imageChambre', $filename1, 'public');
            $request['gal_1'] = '/storage/' . $path1;
        } else {
            dd('Aucun fichier image reçu');
        }

        if ($request->hasFile('gal_2')) {
            $filename2 = time().$request->file('gal_2')->getClientOriginalName();
            $path2 = $request->file('gal_2')->storeAs('imageChambre', $filename2, 'public');
            $request['gal_2'] = '/storage/' . $path2;
        } else {
            dd('Aucun fichier image reçu');
        }

        $chambres= chambres::create([
            'numero_chambre' => $request->numero_chambre,
            'titre_chambre' => $request->titre_chambre,
            'description' => $request->description ?? null,
            'capacite_chambre' => $request->capacite_chambre,
            'statut' => $request->statut,
            'image' => $path,
            'gal_1' => $path1,
            'gal_2' => $path2,
            'type_chambre' => $request->type_chambre,
            'prix_chambre' => $request->prix_chambre,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('chambres.index', compact('chambres'))->with('success', 'Chambre créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chambre = chambres::findOrFail($id);
        $type= room_type::where('nom', $chambre->type_chambre)->first();
        $type_chambre= room_type::all();
        return view('dashboard.chambres.edit', compact('chambre', 'type', 'type_chambre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chambre = chambres::findOrFail($id);

        $request->validate([
            'numero_chambre' => 'required|unique:chambres,numero_chambre,'.$chambre->id,
            'titre_chambre' => 'required',
            'description' => 'nullable',
            'capacite_chambre' => 'required|integer',
            'statut' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gal_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gal_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_chambre' => 'required',
            'prix_chambre' => 'required|numeric',
            'status' => 'boolean',
        ]);

        // Gestion des l'images

        // image principale
        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imageChambre', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        } else {
            dd('Aucun fichier image reçu');
        }
        // img galeries 1 - 2
        if ($request->hasFile('gal_1')) {
            $filename1 = time().$request->file('gal_1')->getClientOriginalName();
            $path1 = $request->file('gal_1')->storeAs('imageChambre', $filename1, 'public');
            $request['gal_1'] = '/storage/' . $path1;
        } else {
            dd('Aucun fichier image reçu');
        }

        if ($request->hasFile('gal_2')) {
            $filename2 = time().$request->file('gal_2')->getClientOriginalName();
            $path2 = $request->file('gal_2')->storeAs('imageChambre', $filename2, 'public');
            $request['gal_2'] = '/storage/' . $path2;
        } else {
            dd('Aucun fichier image reçu');
        }

        $chambre->update([
            'numero_chambre' => $request->numero_chambre,
            'titre_chambre' => $request->titre_chambre,
            'description' => $request->description ?? null,
            'capacite_chambre' => $request->capacite_chambre,
            'statut' => $request->statut,
            'image' => $path,
            'gal_1' => $path1,
            'gal_2' => $path2,
            'type_chambre' => $request->type_chambre,
            'prix_chambre' => $request->prix_chambre,
            'status' => $request->status,
        ]);

        return redirect()->route('chambres.index')->with('success', 'Chambre mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chambre = chambres::findOrFail($id);
        $chambre->delete();

        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès.');
    }

     /**
     * activer un article 
     */  
    public function activate(string $id)
    {
        $chambre = chambres::findOrFail($id);
        
        $chambre->update(['status' => true]);
        //dd($chambre->status);
        return redirect()->back()->with('success', 'Chambre activée avec succès.');
    }
    /**
     * desactiver un article
     */
    public function desactivate(string $id)
    {
        $chambre = chambres::findOrFail($id);
        $chambre->update(['status' => false]);
        return redirect()->back()->with('success', 'Chambre desactivée avec succès.');
    }
}
