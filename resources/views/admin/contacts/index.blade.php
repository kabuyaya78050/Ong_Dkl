@extends('layouts.admin')

@section('title', 'Messages | ONG DKL')

@section('page-title', 'Messages')

@section('content')

<div class="admin-page-header">

    <div>
        <span class="section-label">
            CONTACT
        </span>

        <h1>
            Gestion des <span>messages</span>
        </h1>

        <p>
            Consultez les messages envoyés depuis le site public.
        </p>
    </div>

</div>


{{-- =========================================
     FILTRE
========================================= --}}

<div class="admin-filter-card">

    <form
        action="{{ route('admin.contacts.index') }}"
        method="GET"
        class="filter-form"
    >

        <div class="form-group">

            <label for="read">
                Statut
            </label>

            <select name="read" id="read">

                <option value="">
                    Tous les messages
                </option>

                <option
                    value="0"
                    @selected(request('read') === '0')
                >
                    Non lus
                </option>

                <option
                    value="1"
                    @selected(request('read') === '1')
                >
                    Lus
                </option>

            </select>

        </div>


        <button
            type="submit"
            class="btn btn-primary"
        >
            Filtrer
        </button>


        <a
            href="{{ route('admin.contacts.index') }}"
            class="btn btn-small"
        >
            Réinitialiser
        </a>

    </form>

</div>


{{-- =========================================
     MESSAGES
========================================= --}}

<div class="admin-table-card">

    <div class="table-responsive">

        <table class="admin-table">

            <thead>

                <tr>

                    <th>
                        Expéditeur
                    </th>

                    <th>
                        Sujet
                    </th>

                    <th>
                        Email
                    </th>

                    <th>
                        Statut
                    </th>

                    <th>
                        Date
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($contacts as $contact)

                    <tr class="{{ ! $contact->read ? 'message-unread' : '' }}">

                        {{-- EXPÉDITEUR --}}

                        <td>

                            <div class="contact-admin-info">

                                <div class="contact-avatar">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>

                                <div>

                                    <strong>
                                        {{ $contact->name }}
                                    </strong>

                                    @if(! $contact->read)
                                        <span class="unread-dot"></span>
                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- SUJET --}}

                        <td>

                            <strong>
                                {{ $contact->subject ?? 'Sans sujet' }}
                            </strong>

                        </td>


                        {{-- EMAIL --}}

                        <td>
                            {{ $contact->email }}
                        </td>


                        {{-- STATUT --}}

                        <td>

                            @if($contact->read)

                                <span class="badge badge-confirmed">
                                    ✓ Lu
                                </span>

                            @else

                                <span class="badge badge-pending">
                                    ● Non lu
                                </span>

                            @endif

                        </td>


                        {{-- DATE --}}

                        <td>

                            {{ $contact->created_at->format('d/m/Y') }}

                            <small class="table-time">
                                {{ $contact->created_at->format('H:i') }}
                            </small>

                        </td>


                        {{-- ACTIONS --}}

                        <td>

                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.contacts.show', $contact) }}"
                                    class="btn btn-small"
                                >
                                    👁 Voir
                                </a>


                                @if($contact->read)

                                    <form
                                        action="{{ route('admin.contacts.unread', $contact) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-small btn-warning"
                                        >
                                            ● Non lu
                                        </button>

                                    </form>

                                @endif


                                <form
                                    action="{{ route('admin.contacts.destroy', $contact) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-small btn-danger"
                                    >
                                        🗑 Supprimer
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="empty-table"
                        >
                            Aucun message trouvé.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="pagination-container">

        {{ $contacts->links() }}

    </div>

</div>

@endsection