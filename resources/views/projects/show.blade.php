@extends('layouts.admin')

@section('title', $project->title . ' | ONG DKL')

@section('content')

<section class="project-detail">

    <div class="container">

        <a
            href="{{ route('projects.index') }}"
            class="back-link"
        >
            ← Retour aux projets
        </a>


        <div class="project-detail-grid">

            <div>

                @if($project->image)

                    <img
                        src="{{ asset('images/' . $project->image) }}"
                        alt="{{ $project->title }}"
                        class="project-detail-image"
                    >

                @endif

            </div>


            <div class="project-detail-content">

                <span class="section-label">
                    PROJET ONG DKL
                </span>

                <h1>
                    {{ $project->title }}
                </h1>

                <p class="project-short-description">
                    {{ $project->short_description }}
                </p>


                <div class="project-finance">

                    <div>

                        <span>Objectif</span>

                        <strong>
                            {{ number_format($project->goal_amount, 0, ',', ' ') }}
                            $
                        </strong>

                    </div>


                    <div>

                        <span>Collecté</span>

                        <strong>
                            {{ number_format($project->collected_amount, 0, ',', ' ') }}
                            $
                        </strong>

                    </div>

                </div>


                @php
                    $percentage = $project->goal_amount > 0
                        ? ($project->collected_amount / $project->goal_amount) * 100
                        : 0;

                    $percentage = min($percentage, 100);
                @endphp


                <div class="progress-bar large">

                    <div
                        class="progress-value"
                        style="width: {{ $percentage }}%"
                    ></div>

                </div>


                <p class="progress-text">
                    {{ number_format($percentage, 0) }}%
                    de l'objectif atteint
                </p>


                <a
                    href="{{ url('/don') }}"
                    class="btn btn-donate"
                >
                    Soutenir ce projet
                </a>

            </div>

        </div>


        <div class="project-description">

            <h2>
                À propos du projet
            </h2>

            {!! nl2br(e($project->description)) !!}

        </div>

    </div>

</section>

@endsection