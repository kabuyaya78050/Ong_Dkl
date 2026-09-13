@extends('layouts.app')

@section('title', 'Actualités | ONG DKL')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-label">ONG DKL</span>
        <h1>Nos actualités</h1>
        <p>
            Découvrez les dernières nouvelles, activités et actions
            de l'ONG DKL.
        </p>
    </div>
</section>

<section class="news-section">
    <div class="container">

        @if($news->count())

            <div class="news-grid">

                @foreach($news as $article)

                    <article class="news-card">

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

                        <div class="news-content">

                            <div class="news-date">
                                {{ optional($article->published_at)->format('d/m/Y') }}
                            </div>

                            <h2>
                                {{ $article->title }}
                            </h2>

                            @if($article->excerpt)
                                <p>
                                    {{ $article->excerpt }}
                                </p>
                            @endif

                            <a
                                href="{{ route('news.show', $article->slug) }}"
                                class="btn btn-primary"
                            >
                                Lire l'article →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

            <div class="pagination-container">
                {{ $news->links() }}
            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    📰
                </div>

                <h2>Aucune actualité disponible</h2>

                <p>
                    Nos actualités seront bientôt disponibles.
                </p>

            </div>

        @endif

    </div>
</section>

@endsection