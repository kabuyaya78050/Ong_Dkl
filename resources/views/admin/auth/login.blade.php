<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Administration | ONG DKL</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

</head>

<body class="admin-login-page">

    <div class="login-container">

        <div class="login-card">

            <div class="login-logo">

                <span class="logo-star">
                    ★
                </span>

                <span class="logo-text">
                    ONG <strong>DKL</strong>
                </span>

            </div>


            <span class="section-label">
                ADMINISTRATION
            </span>

            <h1>
                Connexion
            </h1>

            <p class="login-description">
                Connectez-vous à votre espace administrateur.
            </p>


            @if($errors->any())

                <div class="alert alert-error">

                    {{ $errors->first() }}

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('admin.login.submit') }}"
            >

                @csrf


                <div class="form-group">

                    <label for="email">
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn btn-donate login-button"
                >
                    Se connecter
                </button>

            </form>


            <a
                href="{{ route('home') }}"
                class="back-home"
            >
                ← Retour au site
            </a>

        </div>

    </div>

</body>

</html>