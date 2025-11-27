<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;

class reservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_arrivee' => 'required|date',
            'date_depart' => 'required|date|after:date_arrivee',
            'nombre_personnes' => 'required|integer|min:1',
            'room_id' => 'nullable|exists:chambres,id',
            'statut' => 'nullable|string|max:50',
        ]);

        //dd($validatedData);
        // Enregistrer la réservation dans la base de données
        reservation::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_arrivee' => $request->date_arrivee,
            'date_depart' => $request->date_depart,
            'nombre_personnes' => $request->nombre_personnes,
            'room_id' => $request->room_id ?? null,
            'statut' => $request->statut ?? 'en attente',
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été soumise avec succès !');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->back()->with('success', 'Réservation supprimée avec succès.');
    }

    // Reservations en attente
    public function attente()
    {
        $reservations = reservation::where('statut', 'en attente')->get();
        return view('dashboard.reservations.attente', compact('reservations'));
    }

    // Reservation validees
    public function validee()
    {
        $reservations = reservation::where('statut', 'validee')->get();
        return view('dashboard.reservations.valide', compact('reservations'));
    }

    // Reservation refusees
    public function refusee()
    {
        $reservations = reservation::where('statut', 'refusee')->get();
        return view('dashboard.reservations.refuse', compact('reservations'));
    }

    // End Reservations en attente
    public function valider($id)
    {
        $reservation= reservation::findOrFail($id);
        $reservation->update([
            'statut' => 'validee',
        ]); 

        return redirect()->back()->with('success', 'Réservation validée avec succès.');
    }

    // End Reservations validees
    public function refuser($id)
    {
        $reservation= reservation::findOrFail($id);
        $reservation->update([
            'statut' => 'refusee',
        ]);

        return redirect()->back()->with('success', 'Réservation refusée avec succès.');
    }
}
