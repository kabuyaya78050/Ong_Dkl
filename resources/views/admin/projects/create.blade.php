@extends('layouts.app')

@section('title', 'Ajouter un projet - ONG DKL')

@section('content')

<section class="admin-page">

    <div class="container">

        <div class="admin-page-header">
            <div>
                <h1>Ajouter un projet</h1>
                <p>Créer un nouveau projet ONG DKL.</p>
            </div>

            <a
                href="{{ route('admin.projects.index') }}"
                class="btn btn-secondary"
            >
                ← Retour
            </a>
        </div>

        <div class="admin-form-card">

            <form
                action="{{ route('admin.projects.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

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
                        Créer le projet
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection