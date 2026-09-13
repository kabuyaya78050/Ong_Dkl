@extends('layouts.app')

@section('title', 'ONG DKL | Parce que chaque enfant mérite une chance')

@section('content')

{{-- =========================================
     HERO
========================================= --}}

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <span class="hero-label">
                ONG DKL
            </span>

            <h1>
                Parce que chaque enfant
                <span>mérite une chance</span>
            </h1>

            <p>
                Accompagner, soutenir et préparer les enfants
                de 3 à 17 ans à affronter le monde extérieur
                avec des bases solides, fondées sur des valeurs
                spirituelles, civiques et morales.
            </p>

            <div class="hero-actions">

                <a href="{{ url('/don') }}"
                   class="btn btn-donate">
                    Faire un don
                </a>

                <a href="#projets"
                   class="btn btn-outline">
                    Découvrir nos projets
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =========================================
     MISSION / VISION
========================================= --}}

<section class="mission-section">

    <div class="container mission-grid">

        <div class="mission-content">

            <span class="section-label">
                QUI SOMMES-NOUS ?
            </span>

            <h2>
                Notre mission,
                <span>notre vision.</span>
            </h2>

            <p>
                ONG DKL accompagne les enfants et les jeunes
                afin de leur donner les bases nécessaires pour
                construire un avenir meilleur.
            </p>

            <p>
                Notre engagement repose sur l'éducation,
                la spiritualité, la solidarité, la responsabilité
                et le développement du potentiel de chaque enfant.
            </p>

         

        </div>


        <div class="mission-cards">

            <div class="mission-card">

                <div class="card-icon">
                    ★
                </div>

                <h3>Notre Mission</h3>

                <p>
                    Accompagner, soutenir et préparer les enfants
                    à affronter le monde extérieur avec des bases
                    solides.
                </p>

            </div>


            <div class="mission-card vision-card">

                <div class="card-icon">
                    ♥
                </div>

                <h3>Notre Vision</h3>

                <p>
                    Former une génération d'enfants responsables,
                    éveillés, confiants et capables de devenir
                    des acteurs positifs du changement.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================
     VALEURS
========================================= --}}

<section class="values-section">

    <div class="container">

        <div class="section-title">

            <span class="section-label">
                NOS PRINCIPES
            </span>

            <h2>
                Nos <span>valeurs</span>
            </h2>

            <p>
                Des valeurs fortes pour construire une génération
                responsable et engagée.
            </p>

        </div>


        <div class="values-grid">

            <div class="value-card">
                <span class="value-number">01</span>
                <h3>Foi & spiritualité</h3>
                <p>
                    Élever l'enfant dans la connaissance
                    de Dieu et l'amour du prochain.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">02</span>
                <h3>Respect</h3>
                <p>
                    Cultiver la tolérance, la politesse
                    et l'estime des autres.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">03</span>
                <h3>Responsabilité</h3>
                <p>
                    Encourager l'autonomie, l'engagement
                    et la gestion de soi.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">04</span>
                <h3>Intégrité</h3>
                <p>
                    Promouvoir l'honnêteté, la vérité
                    et la justice.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">05</span>
                <h3>Éducation & savoir</h3>
                <p>
                    Valoriser l'apprentissage, la curiosité
                    et l'excellence.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">06</span>
                <h3>Solidarité</h3>
                <p>
                    Apprendre à partager, aider et servir
                    les autres avec amour.
                </p>
            </div>


            <div class="value-card">
                <span class="value-number">07</span>
                <h3>Créativité</h3>
                <p>
                    Libérer les talents, encourager
                    l'expression artistique et le leadership.
                </p>
            </div>

        </div>

    </div>

</section>


{{-- =========================================
     ÉVÉNEMENT
========================================= --}}

<section class="event-section">

    <div class="container event-grid">

        <div class="event-image">

            <img src="{{ asset('images/event.jpg') }}"
                 alt="Activité éducative ONG DKL">

        </div>


        <div class="event-content">

            <span class="section-label">
                AGIR ENSEMBLE
            </span>

            <h2>
                Un événement
                <span>important pour nos enfants</span>
            </h2>

            <p>
                Chaque action compte. Chaque contribution peut
                permettre à un enfant d'avoir accès à de meilleures
                opportunités.
            </p>

            <p>
                Soutenez nos initiatives et participez directement
                à la construction d'un avenir meilleur.
            </p>

            <a href="{{ url('/don') }}"
               class="btn btn-donate">
                Soutenir cette cause
            </a>

        </div>

    </div>

</section>


{{-- =========================================
     VIDÉO
========================================= --}}

<section class="video-section">

    <div class="video-overlay">

        <div class="video-content">

            <button class="play-button">
                ▶
            </button>

            <span>
                Découvrez notre engagement
            </span>

            <h2>
                Ensemble pour donner
                de l'espoir.
            </h2>

        </div>

    </div>

</section>


{{-- =========================================
     PROJETS
========================================= --}}

<section class="projects-section" id="projets">

    <div class="container">

        <div class="section-title">

            <span class="section-label">
                NOS ACTIONS
            </span>

            <h2>
                Projets <span>en vedette</span>
            </h2>

            <p>
                Découvrez quelques-unes de nos actions
                en faveur des enfants et des communautés.
            </p>

        </div>


        <div class="projects-grid">

            <article class="project-card">

                <div class="project-image">

                    <img src="{{ asset('images/project-1.jpg') }}"
                         alt="Projet ONG DKL">

                </div>

                <div class="project-body">

                    <span class="project-category">
                        Éducation
                    </span>

                    <h3>
                        Éducation pour tous
                    </h3>

                    <p>
                        Favoriser l'accès à l'éducation et
                        accompagner les enfants dans leur parcours.
                    </p>

                    <a href="{{ url('/projets') }}">
                        Découvrir le projet →
                    </a>

                </div>

            </article>


            <article class="project-card">

                <div class="project-image">

                    <img src="{{ asset('images/project-2.jpg') }}"
                         alt="Projet ONG DKL">

                </div>

                <div class="project-body">

           
                    <span class="project-category">
                        Formation
                    </span>

                    <h3>
                        Accompagnement des jeunes
                    </h3>

                    <p>
                        Développer les compétences et la confiance
                        des jeunes pour leur avenir.
                    </p>

                    <a href="{{ url('/projets') }}">
                        Découvrir le projet →
                    </a>

                </div>

            </article>


            <article class="project-card">

                <div class="project-image">

                    <img src="{{ asset('images/project-3.jpg') }}"
                         alt="Projet ONG DKL">

                </div>

                <div class="project-body">

                    <span class="project-category">
                        Solidarité
                    </span>

                    <h3>
                        Aide aux enfants
                    </h3>

                    <p>
                        Apporter un soutien aux enfants et aux
                        familles qui en ont le plus besoin.
                    </p>

                    <a href="{{ url('/projets') }}">
                        Découvrir le projet →
                    </a>

                </div>

            </article>

        </div>


        <div class="center-button">

            <a href="{{ url('/projets') }}"
               class="btn btn-dark">
                Voir tous nos projets
            </a>

        </div>

    </div>

</section>
{{-- =========================================
     ACTUALITÉS
========================================= --}}

<section class="home-news-section">

    <div class="container">

        <div class="section-title">

            <span class="section-label">
                NOS ACTUALITÉS
            </span>

            <h2>
                Les dernières <span>nouvelles</span>
            </h2>

            <p>
                Découvrez les dernières activités, actions et
                nouvelles de l'ONG DKL.
            </p>

        </div>


        @if($news->count())

            <div class="news-grid">

                @foreach($news as $article)

                    <article class="news-card">

                        {{-- IMAGE --}}
                        <div class="news-image">

                            @if($article->image)

                                <img
                                    src="{{ asset('storage/' . $article->image) }}"
                                    alt="{{ $article->title }}"
                                >

                            @else

                                <div class="news-placeholder">
                                    📰
                                </div>

                            @endif

                        </div>


                        {{-- CONTENU --}}
                        <div class="news-content">

                            @if($article->published_at)

                                <div class="news-date">
                                    {{ $article->published_at->format('d/m/Y') }}
                                </div>

                            @endif


                            <h3>
                                {{ $article->title }}
                            </h3>


                            @if($article->excerpt)

                                <p>
                                    {{ $article->excerpt }}
                                </p>

                            @endif


                            <a
                                href="{{ route('news.show', $article->slug) }}"
                                class="news-link"
                            >
                                Lire l'article →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- BOUTON --}}
            <div class="center-button">

                <a
                    href="{{ route('news.index') }}"
                    class="btn btn-dark"
                >
                    Voir toutes les actualités
                </a>

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    📰
                </div>

                <h3>
                    Aucune actualité disponible
                </h3>

                <p>
                    Nos prochaines actualités seront bientôt publiées.
                </p>

            </div>

        @endif

    </div>

</section>


{{-- =========================================
     STATISTIQUES
========================================= --}}

<section class="stats-section">

    <div class="container stats-grid">

        <div class="stat">
            <strong>1500+</strong>
            <span>Enfants accompagnés</span>
        </div>

        <div class="stat">
            <strong>400+</strong>
            <span>Volontaires</span>
        </div>

        <div class="stat">
            <strong>7500+</strong>
            <span>Personnes bénéficiaires</span>
        </div>

        <div class="stat">
            <strong>37</strong>
            <span>Projets réalisés</span>
        </div>

    </div>

</section>


{{-- =========================================
     DON
========================================= --}}

<section class="donation-section">

    <div class="container donation-content">

        <span>
            VOTRE GÉNÉROSITÉ CHANGE DES VIES
        </span>

        <h2>
            Chaque don peut faire
            une différence.
        </h2>

        <p>
            Votre soutien nous permet de poursuivre nos actions
            auprès des enfants et de leur offrir de nouvelles
            opportunités.
        </p>

        <a href="{{ url('/don') }}"
           class="btn btn-white">
            Faire un don
        </a>

    </div>

</section>


{{-- =========================================
     VOLONTAIRE
========================================= --}}

<section class="volunteer-section">

    <div class="container volunteer-content">

        <span class="section-label">
            REJOIGNEZ-NOUS
        </span>

        <h2>
            Devenez un <span>volontaire</span>
        </h2>

        <p>
            Votre temps, vos compétences et votre engagement
            peuvent contribuer à changer la vie d'un enfant.
        </p>

        <a href="{{ url('/volontaire') }}"
           class="btn btn-donate">
            Devenir volontaire
        </a>

    </div>

</section>

@endsection