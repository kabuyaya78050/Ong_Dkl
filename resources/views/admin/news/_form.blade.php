<div class="form-group">

    <label for="title">
        Titre
    </label>

    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $news->title ?? '') }}"
        placeholder="Ex : Une nouvelle école pour les enfants"
        required
    >

    @error('title')
        <small class="form-error">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">

    <label for="excerpt">
        Résumé
    </label>

    <textarea
        id="excerpt"
        name="excerpt"
        rows="3"
        placeholder="Présentez brièvement cette actualité..."
    >{{ old('excerpt', $news->excerpt ?? '') }}</textarea>

    @error('excerpt')
        <small class="form-error">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">

    <label for="content">
        Contenu de l'actualité
    </label>

    <textarea
        id="content"
        name="content"
        rows="10"
        placeholder="Écrivez le contenu de votre actualité..."
        required
    >{{ old('content', $news->content ?? '') }}</textarea>

    @error('content')
        <small class="form-error">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">

    <label for="image">
        Image
    </label>

    <input
        type="file"
        id="image"
        name="image"
        accept=".jpg,.jpeg,.png,.webp"
    >

    <small>
        JPG, JPEG, PNG ou WEBP — maximum 5 Mo.
    </small>

    @error('image')
        <small class="form-error">{{ $message }}</small>
    @enderror

</div>


@if(isset($news) && $news->image)

    <div class="current-image">

        <p>Image actuelle :</p>

        <img
            src="{{ asset('storage/' . $news->image) }}"
            alt="{{ $news->title }}"
        >

    </div>

@endif


<div class="form-grid">

    <div class="form-group">

        <label for="published_at">
            Date de publication
        </label>

        <input
            type="datetime-local"
            id="published_at"
            name="published_at"
            value="{{ old(
                'published_at',
                isset($news) && $news->published_at
                    ? $news->published_at->format('Y-m-d\TH:i')
                    : ''
            ) }}"
        >

    </div>


    <div class="form-group">

        <label>
            Publication
        </label>

        <label class="checkbox-label">

            <input
                type="checkbox"
                name="published"
                value="1"
                @checked(old(
                    'published',
                    $news->published ?? false
                ))
            >

            Publier cette actualité

        </label>

    </div>

</div>