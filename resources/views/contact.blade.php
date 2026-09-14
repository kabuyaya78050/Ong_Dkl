@extends('layouts.app')

@section('title', 'Contact | ONG DKL')

@section('content')

<section class="page-hero">

    <div class="container">

        <span class="section-label">
            CONTACTEZ-NOUS
        </span>

        <h1>
            Nous sommes à votre écoute
        </h1>

        <p>
            Une question, une suggestion ou simplement envie
            d'échanger avec nous ? Écrivez-nous.
        </p>

    </div>

</section>


<section class="contact-section">

    <div class="container contact-grid">

        {{-- INFORMATIONS --}}

        <div class="contact-info">

            <span class="section-label">
                PARLONS-NOUS
            </span>

            <h2>
                Comment pouvons-nous
                <span>vous aider ?</span>
            </h2>

            <p>
                N'hésitez pas à nous contacter pour toute question
                concernant nos activités, nos projets ou nos actions
                en faveur des enfants.
            </p>


            <div class="contact-info-list">

                <div class="contact-info-item">

                    <div class="contact-icon">
                        📧
                    </div>

                    <div>
                        <strong>Email</strong>

                        <span>
                         ongdkl01@gmail.com
                        </span>
                    </div>

                </div>


                <div class="contact-info-item">

                    <div class="contact-icon">
                        📞
                    </div>

                    <div>
                        <strong>Téléphone</strong>

                        <span>
                            +243 822 210 2207
                        </span>
                    </div>

                </div>


                <div class="contact-info-item">

                    <div class="contact-icon">
                        📍
                    </div>

                    <div>
                        <strong>Adresse</strong>

                        <span>
                            République Démocratique du Congo
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- FORMULAIRE --}}

        <div class="contact-form-card">

            <h2>
                Envoyez-nous un message
            </h2>

            @if($errors->any())

                <div class="alert alert-error">

                    <strong>
                        Vérifiez les informations saisies.
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('contact.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">

                    <div class="form-group">

                        <label for="name">
                            Nom complet *
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Votre nom"
                            required
                        >

                        @error('name')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="email">
                            Email *
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="votre@email.com"
                            required
                        >

                        @error('email')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

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

                    </div>


                    <div class="form-group">

                        <label for="subject">
                            Sujet
                        </label>

                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            value="{{ old('subject') }}"
                            placeholder="Objet de votre message"
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="message">
                        Message *
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="7"
                        placeholder="Votre message..."
                        required
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <button
                    type="submit"
                    class="btn btn-donate"
                >
                    Envoyer le message →
                </button>

            </form>

        </div>

    </div>

</section>

@endsection