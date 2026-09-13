@extends('layouts.app')

@section('title', 'Ajouter une actualité - ONG DKL')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Ajouter une actualité</h1>
        <p>Publiez une nouvelle actualité de l'ONG DKL.</p>
    </div>

    <a
        href="{{ route('admin.news.index') }}"
        class="btn btn-secondary"
    >
        ← Retour
    </a>

</div>


<div class="admin-form-card">

    <form
        action="{{ route('admin.news.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @include('admin.news._form')

        <div class="form-actions">

            <a
                href="{{ route('admin.news.index') }}"
                class="btn btn-secondary"
            >
                Annuler
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Publier / Enregistrer
            </button>

        </div>

    </form>

</div>

@endsection