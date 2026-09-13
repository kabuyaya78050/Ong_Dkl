@extends('layouts.app')

@section('title', 'Modifier le projet - ONG DKL')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Modifier le projet</h1>
        <p>
            Modifiez les informations de ce projet.
        </p>
    </div>

    <a
        href="{{ route('admin.projects.index') }}"
        class="btn btn-secondary"
    >
        ← Retour aux projets
    </a>

</div>

<div class="admin-form-card">

    <form
        action="{{ route('admin.projects.update', $project) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        @include('admin.projects._form')

        <div class="form-actions">

            <a
                href="{{ route('admin.projects.index') }}"
                class="btn btn-secondary"
            >
                Annuler
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Enregistrer les modifications
            </button>

        </div>

    </form>

</div>

@endsection