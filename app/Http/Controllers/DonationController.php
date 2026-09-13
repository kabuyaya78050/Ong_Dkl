<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Afficher le formulaire de don.
     */
    public function create()
    {
        $projects = Project::where('status', 'active')
            ->latest()
            ->get();

        return view('donations.create', compact('projects'));
    }


    /**
     * Enregistrer la demande de don.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => [
                'nullable',
                'exists:projects,id'
            ],

            'donor_name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1'
            ],

            'payment_method' => [
                'required',
                'in:cash,mobile_money,bank,online'
            ],

            'message' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ]);


        $donation = Donation::create([
            'project_id' => $validated['project_id'] ?? null,

            'donor_name' => $validated['donor_name'],

            'email' => $validated['email'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'amount' => $validated['amount'],

            'payment_method' => $validated['payment_method'],

            'status' => 'pending',

            'message' => $validated['message'] ?? null,
        ]);


        return redirect()
            ->route('donations.success', $donation->id);
    }


    /**
     * Confirmation du don.
     */
    public function success(Donation $donation)
    {
        return view(
            'donations.success',
            compact('donation')
        );
    }
}