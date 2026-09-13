@extends('layouts.admin')

@section('title', 'Bénévoles - ONG DKL')

@section('page-title', 'Bénévoles')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Gestion des bénévoles</h1>

        <p>
            Consultez et gérez les candidatures reçues.
        </p>
    </div>

</div>


{{-- FILTRES --}}

<div class="admin-filter-card">

    <form
        action="{{ route('admin.volunteers.index') }}"
        method="GET"
        class="filter-form"
    >

        <div class="form-group">

            <label for="status">
                Filtrer par statut
            </label>

            <select name="status" id="status">

                <option value="">
                    Tous les statuts
                </option>

                <option
                    value="pending"
                    @selected(request('status') === 'pending')
                >
                    En attente
                </option>

                <option
                    value="accepted"
                    @selected(request('status') === 'accepted')
                >
                    Acceptés
                </option>

                <option
                    value="rejected"
                    @selected(request('status') === 'rejected')
                >
                    Refusés
                </option>

            </select>

        </div>


        <button type="submit" class="btn btn-primary">
            Filtrer
        </button>

        <a
            href="{{ route('admin.volunteers.index') }}"
            class="btn btn-small"
        >
            Réinitialiser
        </a>

    </form>

</div>


{{-- TABLEAU --}}

<div class="admin-table-card">

    <div class="table-responsive">

        <table class="admin-table">

            <thead>

                <tr>
                    <th>Bénévole</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Profession</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @forelse($volunteers as $volunteer)

                    <tr>

                        {{-- NOM --}}

                        <td>

                            <div class="volunteer-admin-info">

                                <div class="volunteer-avatar">

                                    {{ strtoupper(substr($volunteer->first_name, 0, 1)) }}

                                </div>

                                <div>

                                    <strong>
                                        {{ $volunteer->first_name }}
                                        {{ $volunteer->last_name }}
                                    </strong>

                                </div>

                            </div>

                        </td>


                        {{-- EMAIL --}}

                        <td>
                            {{ $volunteer->email }}
                        </td>


                        {{-- TELEPHONE --}}

                        <td>
                            {{ $volunteer->phone ?? '—' }}
                        </td>


                        {{-- PROFESSION --}}

                        <td>
                            {{ $volunteer->profession ?? '—' }}
                        </td>


                        {{-- STATUT --}}

                        <td>

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

                        </td>


                        {{-- DATE --}}

                        <td>

                            {{ $volunteer->created_at->format('d/m/Y') }}

                        </td>


                        {{-- ACTIONS --}}

                        <td>

                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.volunteers.show', $volunteer) }}"
                                    class="btn btn-small"
                                >
                                    👁 Voir
                                </a>


                                @if($volunteer->status !== 'accepted')

                                    <form
                                        action="{{ route('admin.volunteers.accept', $volunteer) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-small btn-success"
                                        >
                                            ✓ Accepter
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
                                            class="btn btn-small btn-warning"
                                        >
                                            ✕ Refuser
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
                            colspan="7"
                            style="text-align:center;"
                        >

                            Aucune candidature trouvée.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="pagination-container">

        {{ $volunteers->links() }}

    </div>

</div>

@endsection