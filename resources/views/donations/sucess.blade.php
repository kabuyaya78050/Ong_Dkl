@extends('layouts.app')

@section('title', 'Merci pour votre don | ONG DKL')

@section('content')

<section class="donation-success">

    <div class="container">

        <div class="success-card">

            <div class="success-icon">
                ✓
            </div>

            <span class="section-label">
                MERCI
            </span>

            <h1>
                Merci pour votre générosité !
            </h1>

            <p>
                Votre demande de don a bien été enregistrée.
            </p>


            <div class="donation-summary">

                <div>
                    <span>Donateur</span>
                    <strong>
                        {{ $donation->donor_name }}
                    </strong>
                </div>

                <div>
                    <span>Montant</span>
                    <strong>
                        {{ number_format($donation->amount, 2, ',', ' ') }}
                        USD
                    </strong>
                </div>

                <div>
                    <span>Statut</span>
                    <strong>
                        En attente
                    </strong>
                </div>

            </div>


            <p class="success-note">
                Notre équipe pourra confirmer votre contribution
                après vérification du paiement.
            </p>


            <a
                href="{{ url('/') }}"
                class="btn btn-donate"
            >
                Retour à l'accueil
            </a>

        </div>

    </div>

</section>

@endsection