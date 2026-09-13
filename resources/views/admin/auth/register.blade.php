@extends('layouts.app')

@section('title', 'Créer un compte - ONG DKL')

@section('content')

<section class="auth-page">

    <div class="auth-card">

        <div class="auth-header">
            <h1>Créer un compte</h1>
            <p>Créer votre compte administrateur ONG DKL</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.register.submit') }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label for="name">Nom complet</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Ex : Administrateur DKL"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@ongdkl.org"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 caractères"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    Confirmer le mot de passe
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Répétez le mot de passe"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary auth-button">
                Créer mon compte
            </button>

        </form>

        <div class="auth-footer">
            <p>
                Vous avez déjà un compte ?
                <a href="{{ route('admin.login') }}">
                    Se connecter
                </a>
            </p>
        </div>

    </div>

</section>

@endsection