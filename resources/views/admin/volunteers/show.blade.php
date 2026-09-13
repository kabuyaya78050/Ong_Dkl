@extends('layouts.admin')

@section('title', 'Candidature - ONG DKL')

@section('page-title', 'Détail de la candidature')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>
            {{ $volunteer->first_name }}
            {{ $volunteer->last_name }}
        </h1>

        <p>
            Détails de la candidature.
        </p>

    </div>

    <a
        href="{{ route('admin.volunteers.index') }}"
        class="btn btn-small"
    >
        ← Retour
    </a>

</div>


<div class="volunteer-detail-grid">

    {{-- INFORMATIONS --}}

    <div class="admin-detail-card">

        <div class="detail-card-header">

            <div class="volunteer-detail-avatar">

                {{ strtoupper(substr($volunteer->first_name, 0, 1)) }}

            </div>

            <div>

                <h2>
                    {{ $volunteer->first_name }}
                    {{ $volunteer->last_name }}
                </h2>

                @if($volunteer->status === 'pending')

                    <span class="badge badge-warning">
                        En attente
                    </span>

                @elseif($volunteer->status === 'accepted')

                    <span class="badge badge-success">
                        Accepté
                    </span>

                @else

                    <span class="badge badge-danger">
                        Refusé
                    </span>

                @endif

            </div>

        </div>


        <div class="detail-list">

            <div class="detail-item">

                <span>
                    E-mail
                </span>

                <strong>
                    {{ $volunteer->email }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Téléphone
                </span>

                <strong>
                    {{ $volunteer->phone ?? 'Non renseigné' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Profession
                </span>

                <strong>
                    {{ $volunteer->profession ?? 'Non renseignée' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Date de candidature
                </span>

                <strong>
                    {{ $volunteer->created_at->format('d/m/Y à H:i') }}
                </strong>

            </div>

        </div>

    </div>


    {{-- MOTIVATION --}}

    <div class="admin-detail-card">

        <h2>
            Motivation
        </h2>

        <div class="motivation-content">

            {!! nl2br(e($volunteer->motivation)) !!}

        </div>

    </div>

</div>


{{-- ACTIONS --}}

<div class="admin-detail-card volunteer-actions-card">

    <h2>
        Actions
    </h2>

    <div class="detail-actions">

        @if($volunteer->status !== 'accepted')

            <form
                action="{{ route('admin.volunteers.accept', $volunteer) }}"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    ✓ Accepter la candidature
                </button>

            </form>

        @endif


        @if($volunteer->status !== 'rejected')

            <form
                action="{{ route('admin.volunteers.reject', $volunteer) }}"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    ✕ Refuser la candidature
                </button>

            </form>

        @endif


        <form
            action="{{ route('admin.volunteers.destroy', $volunteer) }}"
            method="POST"
            onsubmit="return confirm('Voulez-vous vraiment supprimer cette candidature ?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger"
            >
                🗑 Supprimer
            </button>

        </form>

    </div>

</div>

@endsection