@extends('layouts.admin')

@section('title', 'Message | ONG DKL')

@section('page-title', 'Lecture du message')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="section-label">
            MESSAGE
        </span>

        <h1>
            {{ $contact->subject ?? 'Sans sujet' }}
        </h1>

        <p>
            Message reçu le
            {{ $contact->created_at->format('d/m/Y à H:i') }}
        </p>

    </div>


    <a
        href="{{ route('admin.contacts.index') }}"
        class="btn btn-small"
    >
        ← Retour aux messages
    </a>

</div>


<div class="contact-detail-grid">

    {{-- =====================================
         INFORMATIONS EXPÉDITEUR
    ====================================== --}}

    <div class="admin-detail-card">

        <div class="detail-card-header">

            <div class="contact-detail-avatar">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
            </div>

            <div>

                <h2>
                    {{ $contact->name }}
                </h2>

                @if($contact->read)

                    <span class="badge badge-confirmed">
                        ✓ Lu
                    </span>

                @else

                    <span class="badge badge-pending">
                        ● Non lu
                    </span>

                @endif

            </div>

        </div>


        <div class="detail-list">

            <div class="detail-item">

                <span>
                    Nom
                </span>

                <strong>
                    {{ $contact->name }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    E-mail
                </span>

                <strong>
                    {{ $contact->email }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Téléphone
                </span>

                <strong>
                    {{ $contact->phone ?? 'Non renseigné' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Sujet
                </span>

                <strong>
                    {{ $contact->subject ?? 'Sans sujet' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Reçu le
                </span>

                <strong>
                    {{ $contact->created_at->format('d/m/Y à H:i') }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =====================================
         MESSAGE
    ====================================== --}}

    <div class="admin-detail-card">

        <h2>
            Message
        </h2>

        <div class="contact-message-content">

            {!! nl2br(e($contact->message)) !!}

        </div>

    </div>

</div>


{{-- =========================================
     ACTIONS
========================================= --}}

<div class="admin-detail-card contact-actions-card">

    <h2>
        Actions
    </h2>

    <div class="detail-actions">

        @if($contact->read)

            <form
                action="{{ route('admin.contacts.unread', $contact) }}"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    ● Marquer comme non lu
                </button>

            </form>

        @endif


        <a
            href="mailto:{{ $contact->email }}"
            class="btn btn-primary"
        >
            ✉️ Répondre par e-mail
        </a>


        <form
            action="{{ route('admin.contacts.destroy', $contact) }}"
            method="POST"
            onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');"
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