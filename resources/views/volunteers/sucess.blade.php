@extends('layouts.app')

@section('title', 'Candidature envoyée | ONG DKL')

@section('content')

<section class="success-section">

    <div class="container">

        <div class="success-card">

            <div class="success-icon">
                ✓
            </div>

            <span class="section-label">
                MERCI
            </span>

            <h1>
                Candidature envoyée !
            </h1>

            <p>
                Votre candidature pour devenir volontaire
                de l'ONG DKL a bien été enregistrée.
            </p>

            <p>
                Notre équipe examinera votre demande et vous
                contactera si votre profil correspond à nos besoins.
            </p>

            <div class="success-actions">

                <a href="{{ route('home') }}" class="btn btn-dark">
                    Retour à l'accueil
                </a>

                <a href="{{ route('projects.index') }}" class="btn btn-donate">
                    Découvrir nos projets
                </a>

            </div>

        </div>

    </div>

</section>

@endsection