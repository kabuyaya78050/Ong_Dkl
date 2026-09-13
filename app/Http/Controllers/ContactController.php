<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Afficher le formulaire de contact.
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Enregistrer le message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'read' => false,
        ]);

        return redirect()
            ->route('contact.success')
            ->with('success', 'Votre message a été envoyé avec succès.');
    }

    /**
     * Confirmation d'envoi.
     */
    public function success()
    {
        return view('contact-success');
    }
}