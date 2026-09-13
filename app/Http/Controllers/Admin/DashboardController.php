<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord administrateur.
     */
    public function index()
    {
        $stats = [
            // Projets
            'projects' => Project::count(),

            'active_projects' => Project::where(
                'status',
                'active'
            )->count(),

            // Dons
            'donations' => Donation::count(),

            'pending_donations' => Donation::where(
                'status',
                'pending'
            )->count(),

            'confirmed_donations' => Donation::where(
                'status',
                'confirmed'
            )->count(),

            'total_donations' => Donation::where(
                'status',
                'confirmed'
            )->sum('amount'),

            // Bénévoles
            'volunteers' => Volunteer::count(),

            'pending_volunteers' => Volunteer::where(
                'status',
                'pending'
            )->count(),

            // Messages
            'messages' => Contact::count(),

            'unread_messages' => Contact::where(
                'read',
                false
            )->count(),
        ];

        // Les 5 derniers dons
        $recentDonations = Donation::with('project')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'stats',
                'recentDonations'
            )
        );
    }
}