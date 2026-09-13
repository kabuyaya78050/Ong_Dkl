@extends('layouts.app')

@section('title', 'Nos projets | ONG DKL')

@section('content')

<section class="page-header">

    <div class="container">

        <span class="section-label">
            NOS ACTIONS
        </span>

        <h1>
            Nos <span>projets</span>
        </h1>

        <p>
            Découvrez les initiatives mises en place par
            ONG DKL pour accompagner les enfants et les jeunes.
        </p>

    </div>

</section>


<section class="projects-section">

    <div class="container">

        @if($projects->count())

            <div class="projects-grid">

                @foreach($projects as $project)

                    <article class="project-card">

                        <div class="project-image">

                            @if($project->image)

                                <img
                                    src="{{ asset('images/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                >

                            @else

                                <img
                                    src="{{ asset('images/project-default.jpg') }}"
                                    alt="{{ $project->title }}"
                                >

                            @endif

                        </div>


                        <div class="project-body">

                            <span class="project-category">
                                ONG DKL
                            </span>

                            <h3>
                                {{ $project->title }}
                            </h3>

                            <p>
                                {{ $project->short_description }}
                            </p>

                            @if($project->goal_amount > 0)

                                <div class="project-progress">

                                    <div class="progress-info">

                                        <span>
                                            Objectif
                                        </span>

                                        <strong>
                                            {{ number_format($project->goal_amount, 0, ',', ' ') }}
                                            $
                                        </strong>

                                    </div>

                                    <div class="progress-bar">

                                        @php
                                            $percentage = $project->goal_amount > 0
                                                ? ($project->collected_amount / $project->goal_amount) * 100
                                                : 0;

                                            $percentage = min($percentage, 100);
                                        @endphp

                                        <div
                                            class="progress-value"
                                            style="width: {{ $percentage }}%"
                                        ></div>

                                    </div>

                                    <small>
                                        {{ number_format($percentage, 0) }}%
                                        financé
                                    </small>

                                </div>

                            @endif


                            <a
                                href="{{ route('projects.show', $project->slug) }}"
                                class="project-link"
                            >
                                Voir le projet →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            <div class="pagination">

                {{ $projects->links() }}

            </div>

        @else

            <div class="empty-state">

                <h3>
                    Aucun projet disponible
                </h3>

                <p>
                    Nos projets seront bientôt publiés.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection