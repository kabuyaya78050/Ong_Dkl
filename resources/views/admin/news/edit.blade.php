@extends('layouts.app')

@section('title', 'Modifier une actualité - ONG DKL')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Modifier l'actualité</h1>
        <p>{{ $news->title }}</p>
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
        action="{{ route('admin.news.update', $news) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

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
                Enregistrer les modifications
            </button>

        </div>

    </form>

</div>

@endsection