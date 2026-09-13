@extends('layouts.app')

@section('title', $article->title . ' | ONG DKL')

@section('content')

<section class="page-hero">
    <div class="container">

        <span class="section-label">
            Actualité
        </span>

        <h1>{{ $article->title }}</h1>

        @if($article->published_at)
            <p>
                Publié le
                {{ $article->published_at->format('d/m/Y') }}
            </p>
        @endif

    </div>
</section>

<section class="news-detail-section">
    <div class="container">

        <div class="news-detail">

            @if($article->image)

                <div class="news-detail-image">
                    <img
                        src="{{ asset('storage/' . $article->image) }}"
                        alt="{{ $article->title }}"
                    >
                </div>

            @endif

            <div class="news-detail-content">

                @if($article->published_at)
                    <div class="news-date">
                        {{ $article->published_at->format('d/m/Y') }}
                    </div>
                @endif

                <h2>
                    {{ $article->title }}
                </h2>

                @if($article->excerpt)
                    <p class="news-lead">
                        {{ $article->excerpt }}
                    </p>
                @endif

                <div class="news-text">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <div class="news-back">

                    <a
                        href="{{ route('news.index') }}"
                        class="btn btn-secondary"
                    >
                        ← Retour aux actualités
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection