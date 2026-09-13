@extends('layouts.app')

@section('title', 'Faire un don | ONG DKL')

@section('content')

<section class="donation-page">

    <div class="container">

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
                aux enfants.
            </p>

        </div>


        <div class="donation-form-wrapper">

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


                {{-- Nom --}}

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


                {{-- Email --}}

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


                    {{-- Téléphone --}}

                    <div class="form-group">

                        <label for="phone">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') }}"
                            placeholder="+243..."
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
                            step="0.01"
                            placeholder="50"
                            required
                        >

                        <span>
                            USD
                        </span>

                    </div>

                    @error('amount')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Méthode de paiement --}}

                <div class="form-group">

                    <label>
                        Mode de paiement *
                    </label>

                    <div class="payment-options">

                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="mobile_money"
                                {{ old('payment_method') == 'mobile_money' ? 'checked' : '' }}
                                required
                            >

                            <span>
                                Mobile Money
                            </span>

                        </label>


                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="bank"
                                {{ old('payment_method') == 'bank' ? 'checked' : '' }}
                            >

                            <span>
                                Virement bancaire
                            </span>

                        </label>


                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="cash"
                                {{ old('payment_method') == 'cash' ? 'checked' : '' }}
                            >

                            <span>
                                Espèces
                            </span>

                        </label>


                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="online"
                                {{ old('payment_method') == 'online' ? 'checked' : '' }}
                            >

                            <span>
                                Paiement en ligne
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


                <button
                    type="submit"
                    class="btn btn-donate donation-submit"
                >
                    Continuer mon don
                </button>

            </form>


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
                    <span>Choisissez le projet</span>
                </div>

                <div class="donation-info-item">
                    <strong>02</strong>
                    <span>Indiquez votre contribution</span>
                </div>

                <div class="donation-info-item">
                    <strong>03</strong>
                    <span>Choisissez votre moyen de paiement</span>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection