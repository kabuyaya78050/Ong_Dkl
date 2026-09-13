<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Afficher le formulaire de candidature.
     */
    public function create()
    {
        return view('volunteers.create');
    }

    /**
     * Enregistrer une candidature.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'profession' => ['nullable', 'string', 'max:255'],
            'motivation' => ['required', 'string', 'max:2000'],
        ]);

        Volunteer::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'profession' => $validated['profession'] ?? null,
            'motivation' => $validated['motivation'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('volunteers.success')
            ->with('success', 'Votre candidature a été envoyée avec succès.');
    }

    /**
     * Page de confirmation.
     */
    public function success()
    {
        return view('volunteers.success');
    }
}