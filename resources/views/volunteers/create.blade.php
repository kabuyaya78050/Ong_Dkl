@extends('layouts.app')

@section('title', 'Devenir volontaire | ONG DKL')

@section('content')

<section class="page-hero">

    <div class="container">

        <span class="section-label">
            REJOIGNEZ-NOUS
        </span>

        <h1>
            Devenir volontaire
        </h1>

        <p>
            Votre temps, vos compétences et votre engagement
            peuvent contribuer à changer la vie d'un enfant.
        </p>

    </div>

</section>


<section class="volunteer-form-section">

    <div class="container volunteer-form-grid">

        {{-- INTRODUCTION --}}

        <div class="volunteer-intro">

            <span class="section-label">
                AGIR AVEC NOUS
            </span>

            <h2>
                Faites partie de
                <span>l'aventure</span>
            </h2>

            <p>
                L'ONG DKL accueille les personnes qui souhaitent
                mettre leur temps, leurs compétences et leur énergie
                au service des enfants et des communautés.
            </p>

            <p>
                Remplissez le formulaire et présentez-nous votre
                motivation. Notre équipe examinera votre candidature
                et vous contactera.
            </p>

            <div class="volunteer-benefits">

                <div class="volunteer-benefit">
                    <span>✓</span>
                    <p>Contribuer à nos actions</p>
                </div>

                <div class="volunteer-benefit">
                    <span>✓</span>
                    <p>Partager vos compétences</p>
                </div>

                <div class="volunteer-benefit">
                    <span>✓</span>
                    <p>Accompagner les enfants</p>
                </div>

                <div class="volunteer-benefit">
                    <span>✓</span>
                    <p>Participer au changement</p>
                </div>

            </div>

        </div>


        {{-- FORMULAIRE --}}

        <div class="volunteer-form-card">

            <div class="form-card-header">

                <h2>
                    Candidature
                </h2>

                <p>
                    Tous les champs obligatoires sont indiqués.
                </p>

            </div>


            @if($errors->any())

                <div class="alert alert-error">

                    <strong>
                        Vérifiez les informations saisies.
                    </strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <form
                action="{{ route('volunteers.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">

                    <div class="form-group">

                        <label for="first_name">
                            Prénom *
                        </label>

                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="Votre prénom"
                            required
                        >

                        @error('first_name')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="last_name">
                            Nom *
                        </label>

                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Votre nom"
                            required
                        >

                        @error('last_name')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                <div class="form-group">

                    <label for="email">
                        Adresse e-mail *
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="exemple@email.com"
                        required
                    >

                    @error('email')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label for="phone">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+243 ..."
                        >

                        @error('phone')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="profession">
                            Profession
                        </label>

                        <input
                            type="text"
                            id="profession"
                            name="profession"
                            value="{{ old('profession') }}"
                            placeholder="Votre profession"
                        >

                        @error('profession')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                <div class="form-group">

                    <label for="motivation">
                        Pourquoi souhaitez-vous devenir volontaire ? *
                    </label>

                    <textarea
                        id="motivation"
                        name="motivation"
                        rows="6"
                        placeholder="Présentez brièvement votre motivation..."
                        required
                    >{{ old('motivation') }}</textarea>

                    @error('motivation')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <button
                    type="submit"
                    class="btn btn-donate"
                >
                    Envoyer ma candidature →
                </button>

            </form>

        </div>

    </div>

</section>

@endsection