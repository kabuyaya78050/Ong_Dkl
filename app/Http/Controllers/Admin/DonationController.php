<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * Liste des dons.
     */
    public function index(Request $request)
    {
        $query = Donation::with('project')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $donations = $query->paginate(15)
            ->withQueryString();

        return view('admin.donations.index', compact('donations'));
    }


    /**
     * Détails d'un don.
     */
    public function show(Donation $donation)
    {
        $donation->load('project');

        return view(
            'admin.donations.show',
            compact('donation')
        );
    }


    /**
     * Confirmer un don.
     */
    public function confirm(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return back()->with(
                'error',
                'Ce don a déjà été traité.'
            );
        }

        DB::transaction(function () use ($donation) {

            $donation->update([
                'status' => 'confirmed',
            ]);

            if ($donation->project_id) {

                $donation->project()
                    ->increment(
                        'collected_amount',
                        $donation->amount
                    );
            }
        });

        return back()->with(
            'success',
            'Le don a été confirmé avec succès.'
        );
    }


    /**
     * Annuler un don.
     */
    public function cancel(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return back()->with(
                'error',
                'Ce don a déjà été traité.'
            );
        }

        $donation->update([
            'status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Le don a été annulé.'
        );
    }
}