@extends('layouts.app')

@section('title', 'Faire un don | ONG DKL')

@section('content')

<section class="donation-page">

    <div class="container">

        {{-- En-tête --}}
        <div class="donation-header">

            <span class="section-label">
                SOUTENEZ NOTRE ACTION
            </span>

            <h1>
                Faites un <span>don</span>
            </h1>

            <p>
                Votre générosité contribue directement à améliorer
                les conditions de vie et les opportunités offertes
                aux enfants et aux jeunes.
            </p>

        </div>


        <div class="donation-form-wrapper">

            {{-- FORMULAIRE --}}
            <form
                method="POST"
                action="{{ route('donations.store') }}"
                class="donation-form"
            >

                @csrf


                {{-- Projet --}}
                <div class="form-group">

                    <label for="project_id">
                        Projet à soutenir
                    </label>

                    <select
                        name="project_id"
                        id="project_id"
                    >

                        <option value="">
                            Choisir un projet
                        </option>

                        @foreach($projects as $project)

                            <option
                                value="{{ $project->id }}"
                                {{ old('project_id') == $project->id ? 'selected' : '' }}
                            >
                                {{ $project->title }}
                            </option>

                        @endforeach

                    </select>

                    @error('project_id')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Nom complet --}}
                <div class="form-group">

                    <label for="donor_name">
                        Nom complet *
                    </label>

                    <input
                        type="text"
                        name="donor_name"
                        id="donor_name"
                        value="{{ old('donor_name') }}"
                        placeholder="Votre nom complet"
                        required
                    >

                    @error('donor_name')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Email + Téléphone --}}
                <div class="form-row">

                    <div class="form-group">

                        <label for="email">
                            Adresse email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com"
                        >

                        @error('email')
                            <small class="error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="phone">
                            Numéro Mobile Money *
                        </label>

                        <input
                            type="tel"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') }}"
                            placeholder="+243 XXX XXX XXX"
                            required
                        >

                        @error('phone')
                            <small class="error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- Montant --}}
                <div class="form-group">

                    <label for="amount">
                        Montant du don *
                    </label>

                    <div class="amount-input">

                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            value="{{ old('amount') }}"
                            min="1"
                            step="1"
                            placeholder="50000"
                            required
                        >

                        <span>
                            CDF
                        </span>

                    </div>

                    @error('amount')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Opérateur Mobile Money --}}
                <div class="form-group">

                    <label>
                        Opérateur Mobile Money *
                    </label>

                    <div class="payment-options">

                        {{-- M-Pesa --}}
                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="mpesa"
                                {{ old('payment_method') === 'mpesa' ? 'checked' : '' }}
                                required
                            >

                            <span>
                                M-Pesa
                            </span>

                        </label>


                        {{-- Orange Money --}}
                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="orange_money"
                                {{ old('payment_method') === 'orange_money' ? 'checked' : '' }}
                            >

                            <span>
                                Orange Money
                            </span>

                        </label>


                        {{-- Airtel Money --}}
                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="airtel_money"
                                {{ old('payment_method') === 'airtel_money' ? 'checked' : '' }}
                            >

                            <span>
                                Airtel Money
                            </span>

                        </label>


                        {{-- AfriMoney --}}
                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="afrimoney"
                                {{ old('payment_method') === 'afrimoney' ? 'checked' : '' }}
                            >

                            <span>
                                AfriMoney
                            </span>

                        </label>

                    </div>

                    @error('payment_method')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Message --}}
                <div class="form-group">

                    <label for="message">
                        Message
                    </label>

                    <textarea
                        name="message"
                        id="message"
                        rows="5"
                        placeholder="Un message pour l'équipe ONG DKL..."
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Bouton --}}
                <button
                    type="submit"
                    class="btn btn-donate donation-submit"
                >
                    Continuer le paiement
                </button>

            </form>


            {{-- INFORMATIONS --}}
            <div class="donation-info">

                <h2>
                    Votre don compte
                </h2>

                <p>
                    Chaque contribution nous aide à poursuivre
                    nos actions auprès des enfants et des jeunes.
                </p>


                <div class="donation-info-item">
                    <strong>01</strong>
                    <span>Choisissez le projet à soutenir</span>
                </div>


                <div class="donation-info-item">
                    <strong>02</strong>
                    <span>Indiquez le montant de votre don</span>
                </div>


                <div class="donation-info-item">
                    <strong>03</strong>
                    <span>Choisissez votre opérateur Mobile Money</span>
                </div>


                <div class="donation-info-item">
                    <strong>04</strong>
                    <span>Effectuez le paiement et recevez la confirmation</span>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection