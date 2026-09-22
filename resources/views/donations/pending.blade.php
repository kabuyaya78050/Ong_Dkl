@extends('layouts.app')

@section('title', 'Paiement en cours | ONG DKL')

@section('content')

<section class="donation-page">

    <div class="container">

        <div class="donation-header">

            <span class="section-label">
                PAIEMENT MOBILE MONEY
            </span>

            <h1>
                Paiement <span>en cours</span>
            </h1>

            <p>
                Votre demande de paiement a été envoyée.
                Veuillez suivre les instructions reçues sur
                votre téléphone pour confirmer le paiement.
            </p>

        </div>

        <div class="donation-form-wrapper">

            <div class="donation-form">

                <div class="donation-info-item">
                    <strong>01</strong>
                    <span>
                        Vérifiez votre téléphone
                    </span>
                </div>

                <div class="donation-info-item">
                    <strong>02</strong>
                    <span>
                        Confirmez le paiement Mobile Money
                    </span>
                </div>

                <div class="donation-info-item">
                    <strong>03</strong>
                    <span>
                        Attendez la confirmation de votre transaction
                    </span>
                </div>

                <hr>

                <p>
                    <strong>Montant :</strong>
                    {{ number_format($donation->amount, 0, ',', ' ') }}
                    CDF
                </p>

                <p>
                    <strong>Numéro :</strong>
                    {{ $donation->phone }}
                </p>

                <p>
                    <strong>Référence :</strong>
                    {{ $donation->transaction_reference }}
                </p>

                <p>
                    <strong>Statut :</strong>
                    En attente du paiement
                </p>

            </div>

        </div>

    </div>

</section>

@endsection