@extends('layouts.app')

@section('title', 'Gestion des projets - ONG DKL')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Gestion des projets</h1>
        <p>Gérez les projets de l'ONG DKL.</p>
    </div>

    <a
        href="{{ route('admin.projects.create') }}"
        class="btn btn-primary"
    >
        + Ajouter un projet
    </a>

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


{{-- Tableau --}}

<div class="admin-table-card">

    <div class="table-responsive">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Objectif</th>
                    <th>Collecté</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($projects as $project)

                    <tr>

                        {{-- PROJET --}}

                        <td>

                            <div class="project-admin-info">

                                @if($project->image)

                                    <img
                                        src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->title }}"
                                        class="project-admin-image"
                                    >

                                @else

                                    <div class="project-admin-placeholder">
                                        📷
                                    </div>

                                @endif

                                <div>

                                    <strong>
                                        {{ $project->title }}
                                    </strong>

                                    <small>
                                        {{ $project->slug }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- OBJECTIF --}}

                        <td>
                            <strong>
                                ${{ number_format($project->goal_amount, 2) }}
                            </strong>
                        </td>


                        {{-- COLLECTÉ --}}

                        <td>
                            ${{ number_format($project->collected_amount, 2) }}
                        </td>


                        {{-- STATUT --}}

                        <td>

                            @if($project->status === 'active')

                                <span class="badge badge-success">
                                    Publié
                                </span>

                            @elseif($project->status === 'completed')

                                <span class="badge badge-info">
                                    Terminé
                                </span>

                            @else

                                <span class="badge badge-warning">
                                    Brouillon
                                </span>

                            @endif

                        </td>


                        {{-- ACTIONS --}}

                        <td>

                            <div class="table-actions">

                                {{-- Voir --}}

                                <a
                                    href="{{ route('projects.show', $project->slug) }}"
                                    target="_blank"
                                    class="btn btn-small"
                                >
                                    👁 Voir
                                </a>


                                {{-- Modifier --}}

                                <a
                                    href="{{ route('admin.projects.edit', $project) }}"
                                    class="btn btn-small"
                                >
                                    ✏️ Modifier
                                </a>


                                {{-- Publier / Dépublier --}}

                                <form
                                    action="{{ route('admin.projects.status', $project) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-small"
                                    >

                                        @if($project->status === 'active')
                                            🟡 Dépublier
                                        @else
                                            🟢 Publier
                                        @endif

                                    </button>

                                </form>


                                {{-- Supprimer --}}

                                <form
                                    action="{{ route('admin.projects.destroy', $project) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce projet ?');"
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

                        <td colspan="5" style="text-align: center;">

                            Aucun projet enregistré.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}

    <div class="pagination-container">

        {{ $projects->links() }}

    </div>

</div>

@endsection