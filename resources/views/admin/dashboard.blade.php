@extends('layouts.admin')

@section('title', 'Dashboard | ONG DKL')

@section('page-title', 'Tableau de bord')

@section('content')

<div class="dashboard-header">

    <div>

        <span class="section-label">
            ADMINISTRATION
        </span>

        <h1>
            Tableau de <span>bord</span>
        </h1>

        <p>
            Bienvenue dans l'espace d'administration de l'ONG DKL.
        </p>

    </div>

</div>


{{-- =========================================
     STATISTIQUES
========================================= --}}

<div class="dashboard-stats">

    {{-- PROJETS --}}

    <div class="dashboard-stat">
        <span>Projets</span>
        <strong>{{ $stats['projects'] }}</strong>
    </div>


    {{-- PROJETS ACTIFS --}}

    <div class="dashboard-stat">
        <span>Projets actifs</span>
        <strong>{{ $stats['active_projects'] }}</strong>
    </div>


    {{-- DONS CONFIRMÉS --}}

    <div class="dashboard-stat">
        <span>Dons confirmés</span>
        <strong>{{ $stats['confirmed_donations'] }}</strong>
    </div>


    {{-- MONTANT COLLECTÉ --}}

    <div class="dashboard-stat">
        <span>Montant collecté</span>

        <strong>
            {{ number_format($stats['total_donations'], 0, ',', ' ') }}
            $
        </strong>
    </div>


    {{-- DONS EN ATTENTE --}}

    <div class="dashboard-stat">
        <span>Dons en attente</span>
        <strong>{{ $stats['pending_donations'] }}</strong>
    </div>


    {{-- VOLONTAIRES --}}

    <div class="dashboard-stat">
        <span>Volontaires</span>
        <strong>{{ $stats['volunteers'] }}</strong>
    </div>


    {{-- MESSAGES --}}

    <div class="dashboard-stat">
        <span>Messages</span>
        <strong>{{ $stats['messages'] }}</strong>
    </div>

</div>


{{-- =========================================
     RACCOURCIS
========================================= --}}

<div class="dashboard-section">

    <div class="dashboard-section-header">

        <h2>
            Actions rapides
        </h2>

    </div>


    <div class="dashboard-shortcuts">

        {{-- PROJETS --}}

        <a
            href="{{ route('admin.projects.index') }}"
            class="dashboard-action"
        >

            <strong>
                📁 Gérer les projets
            </strong>

            <span>
                Ajouter, modifier ou publier un projet
            </span>

        </a>


        {{-- DONS --}}

        <a
            href="{{ route('admin.donations.index') }}"
            class="dashboard-action"
        >

            <strong>
                💰 Gérer les dons
            </strong>

            <span>
                Consulter et confirmer les dons
            </span>

        </a>


        {{-- ACTUALITÉS --}}

        <a
            href="{{ route('admin.news.index') }}"
            class="dashboard-action"
        >

            <strong>
                📰 Gérer les actualités
            </strong>

            <span>
                Publier et gérer les actualités
            </span>

        </a>


        {{-- BÉNÉVOLES --}}

        <a
            href="{{ route('admin.volunteers.index') }}"
            class="dashboard-action"
        >

            <strong>
                👥 Gérer les bénévoles
            </strong>

            <span>
                Consulter et traiter les candidatures
            </span>

        </a>



        {{-- SITE PUBLIC --}}

        <a
            href="{{ route('home') }}"
            target="_blank"
            class="dashboard-action"
        >

            <strong>
                🌐 Voir le site
            </strong>

            <span>
                Ouvrir le site public
            </span>

        </a>

    </div>

</div>


{{-- =========================================
     DERNIERS DONS
========================================= --}}

<div class="dashboard-section">

    <div class="dashboard-section-header">

        <h2>
            Derniers dons
        </h2>

        <a href="{{ route('admin.donations.index') }}">
            Voir tous →
        </a>

    </div>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>

                    <th>
                        Donateur
                    </th>

                    <th>
                        Projet
                    </th>

                    <th>
                        Montant
                    </th>

                    <th>
                        Statut
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($recentDonations as $donation)

                    <tr>

                        <td>

                            <strong>
                                {{ $donation->donor_name }}
                            </strong>

                        </td>


                        <td>

                            {{ $donation->project?->title ?? 'Général' }}

                        </td>


                        <td>

                            <strong>
                                {{ number_format(
                                    $donation->amount,
                                    2,
                                    ',',
                                    ' '
                                ) }}
                                USD
                            </strong>

                        </td>


                        <td>

                            @if($donation->status === 'pending')

                                <span class="badge badge-pending">
                                    En attente
                                </span>

                            @elseif($donation->status === 'confirmed')

                                <span class="badge badge-confirmed">
                                    Confirmé
                                </span>

                            @else

                                <span class="badge badge-cancelled">
                                    Annulé
                                </span>

                            @endif

                        </td>


                        <td>

                            {{ $donation->created_at->format('d/m/Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="empty-table"
                        >

                            Aucun don pour le moment.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection