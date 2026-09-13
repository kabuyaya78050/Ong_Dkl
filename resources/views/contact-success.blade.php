@extends('layouts.app')

@section('title', 'Message envoyé | ONG DKL')

@section('content')

<section class="success-section">

    <div class="container">

        <div class="success-card">

            <div class="success-icon">
                ✓
            </div>

            <span class="section-label">
                MESSAGE ENVOYÉ
            </span>

            <h1>
                Merci pour votre message !
            </h1>

            <p>
                Votre message a bien été reçu par l'ONG DKL.
            </p>

            <p>
                Notre équipe prendra connaissance de votre demande
                et vous répondra dans les meilleurs délais.
            </p>

            <div class="success-actions">

                <a
                    href="{{ route('home') }}"
                    class="btn btn-dark"
                >
                    Retour à l'accueil
                </a>

                <a
                    href="{{ route('news.index') }}"
                    class="btn btn-donate"
                >
                    Voir nos actualités
                </a>

            </div>

        </div>

    </div>

</section>

@endsection