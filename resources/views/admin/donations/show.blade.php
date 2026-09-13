@extends('layouts.app')

@section('title', 'Détail du don | ONG DKL')

@section('content')

<section class="admin-page">

    <div class="container">

        <a
            href="{{ route('admin.donations.index') }}"
            class="back-link"
        >
            ← Retour aux dons
        </a>


        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        <div class="donation-detail-card">

            <div class="donation-detail-header">

                <div>

                    <span class="section-label">
                        DON #{{ $donation->id }}
                    </span>

                    <h1>
                        {{ $donation->donor_name }}
                    </h1>

                </div>


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

            </div>


            <div class="donation-detail-grid">

                <div>
                    <span>Montant</span>

                    <strong class="detail-amount">
                        {{ number_format($donation->amount, 2, ',', ' ') }}
                        USD
                    </strong>
                </div>


                <div>
                    <span>Projet</span>

                    <strong>
                        {{ $donation->project?->title ?? 'Don général' }}
                    </strong>
                </div>


                <div>
                    <span>Email</span>

                    <strong>
                        {{ $donation->email ?? 'Non renseigné' }}
                    </strong>
                </div>


                <div>
                    <span>Téléphone</span>

                    <strong>
                        {{ $donation->phone ?? 'Non renseigné' }}
                    </strong>
                </div>


                <div>
                    <span>Mode de paiement</span>

                    <strong>
                        {{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}
                    </strong>
                </div>


                <div>
                    <span>Date</span>

                    <strong>
                        {{ $donation->created_at->format('d/m/Y H:i') }}
                    </strong>
                </div>

            </div>


            @if($donation->message)

                <div class="donation-message">

                    <h3>
                        Message
                    </h3>

                    <p>
                        {{ $donation->message }}
                    </p>

                </div>

            @endif


            @if($donation->status === 'pending')

                <div class="donation-actions">

                    <form
                        method="POST"
                        action="{{ route('admin.donations.confirm', $donation) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-confirm"
                        >
                            ✓ Confirmer le don
                        </button>

                    </form>


                    <form
                        method="POST"
                        action="{{ route('admin.donations.cancel', $donation) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-cancel"
                        >
                            Annuler le don
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</section>

@endsection