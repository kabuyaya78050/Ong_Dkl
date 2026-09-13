<div class="form-group">
    <label for="title">Titre du projet</label>

    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $project->title ?? '') }}"
        placeholder="Ex : Éducation pour tous"
        required
    >

    @error('title')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="short_description">
        Description courte
    </label>

    <textarea
        id="short_description"
        name="short_description"
        rows="3"
        placeholder="Une courte présentation du projet..."
    >{{ old('short_description', $project->short_description ?? '') }}</textarea>

    @error('short_description')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="description">
        Description complète
    </label>

    <textarea
        id="description"
        name="description"
        rows="7"
        placeholder="Décrivez le projet en détail..."
    >{{ old('description', $project->description ?? '') }}</textarea>

    @error('description')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-grid">

    <div class="form-group">
        <label for="goal_amount">
            Objectif financier
        </label>

        <input
            type="number"
            id="goal_amount"
            name="goal_amount"
            value="{{ old('goal_amount', $project->goal_amount ?? 0) }}"
            min="0"
            step="0.01"
            required
        >

        @error('goal_amount')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Statut</label>

        <select id="status" name="status" required>
            <option
                value="draft"
                @selected(old('status', $project->status ?? 'draft') === 'draft')
            >
                Brouillon
            </option>

            <option
                value="active"
                @selected(old('status', $project->status ?? '') === 'active')
            >
                Publié
            </option>

            <option
                value="completed"
                @selected(old('status', $project->status ?? '') === 'completed')
            >
                Terminé
            </option>
        </select>

        @error('status')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

</div>

<div class="form-group">
    <label for="image">Image du projet</label>

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

@if(isset($project) && $project->image)

    <div class="current-image">
        <p>Image actuelle :</p>

        <img
            src="{{ asset('storage/' . $project->image) }}"
            alt="{{ $project->title }}"
        >
    </div>

@endif