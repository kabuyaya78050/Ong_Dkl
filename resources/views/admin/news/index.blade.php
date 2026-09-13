@extends('layouts.app')

@section('title', 'Gestion des actualités - ONG DKL')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Gestion des actualités</h1>
        <p>Gérez les actualités de l'ONG DKL.</p>
    </div>

    <a
        href="{{ route('admin.news.create') }}"
        class="btn btn-primary"
    >
        + Ajouter une actualité
    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="admin-table-card">

    <div class="table-responsive">

        <table class="admin-table">

            <thead>

                <tr>
                    <th>Actualité</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @forelse($news as $article)

                    <tr>

                        <td>

                            <div class="project-admin-info">

                                @if($article->image)

                                    <img
                                        src="{{ asset('storage/' . $article->image) }}"
                                        alt="{{ $article->title }}"
                                        class="project-admin-image"
                                    >

                                @else

                                    <div class="project-admin-placeholder">
                                        📰
                                    </div>

                                @endif

                                <div>

                                    <strong>
                                        {{ $article->title }}
                                    </strong>

                                    <small>
                                        {{ $article->slug }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>

                            @if($article->published_at)

                                {{ $article->published_at->format('d/m/Y H:i') }}

                            @else

                                —

                            @endif

                        </td>


                        <td>

                            @if($article->published)

                                <span class="badge badge-success">
                                    Publiée
                                </span>

                            @else

                                <span class="badge badge-warning">
                                    Brouillon
                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.news.edit', $article) }}"
                                    class="btn btn-small"
                                >
                                    ✏️ Modifier
                                </a>


                                <form
                                    action="{{ route('admin.news.status', $article) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-small"
                                    >
                                        @if($article->published)
                                            🟡 Dépublier
                                        @else
                                            🟢 Publier
                                        @endif
                                    </button>

                                </form>


                                <form
                                    action="{{ route('admin.news.destroy', $article) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette actualité ?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-small btn-danger"
                                    >
                                        🗑 Supprimer
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            style="text-align:center;"
                        >
                            Aucune actualité enregistrée.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="pagination-container">

        {{ $news->links() }}

    </div>

</div>

@endsection