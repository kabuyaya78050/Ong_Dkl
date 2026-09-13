@extends('layouts.app')

@section('title', 'Gestion des dons | ONG DKL')

@section('content')

<section class="admin-page">

    <div class="container">

        <div class="admin-header">

            <div>
                <span class="section-label">
                    ADMINISTRATION
                </span>

                <h1>
                    Gestion des <span>dons</span>
                </h1>
            </div>

        </div>


        {{-- Messages --}}

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


        {{-- Filtre --}}

        <form
            method="GET"
            action="{{ route('admin.donations.index') }}"
            class="filter-form"
        >

            <select name="status">

                <option value="">
                    Tous les statuts
                </option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    En attente
                </option>

                <option
                    value="confirmed"
                    {{ request('status') === 'confirmed' ? 'selected' : '' }}
                >
                    Confirmés
                </option>

                <option
                    value="cancelled"
                    {{ request('status') === 'cancelled' ? 'selected' : '' }}
                >
                    Annulés
                </option>

            </select>

            <button class="btn btn-dark">
                Filtrer
            </button>

        </form>


        {{-- Tableau --}}

        <div class="admin-table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>Donateur</th>

                        <th>Projet</th>

                        <th>Montant</th>

                        <th>Paiement</th>

                        <th>Statut</th>

                        <th>Date</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($donations as $donation)

                        <tr>

                            <td>
                                <strong>
                                    {{ $donation->donor_name }}
                                </strong>

                                @if($donation->email)
                                    <small>
                                        {{ $donation->email }}
                                    </small>
                                @endif
                            </td>


                            <td>
                                {{ $donation->project?->title ?? 'Général' }}
                            </td>


                            <td>
                                <strong>
                                    {{ number_format($donation->amount, 2, ',', ' ') }}
                                    USD
                                </strong>
                            </td>


                            <td>
                                {{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}
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
                                {{ $donation->created_at->format('d/m/Y H:i') }}
                            </td>


                            <td>

                                <a
                                    href="{{ route('admin.donations.show', $donation) }}"
                                    class="table-link"
                                >
                                    Voir
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-table"
                            >
                                Aucun don trouvé.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="pagination">

            {{ $donations->links() }}

        </div>

    </div>

</section>

@endsection