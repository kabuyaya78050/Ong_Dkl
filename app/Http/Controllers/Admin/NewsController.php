<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data = $validated;

        $data['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );

        $data['published'] = $request->boolean('published');

        if ($data['published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('news', 'public');
        }

        News::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'L’actualité a été créée avec succès.'
            );
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data = $validated;

        if ($news->title !== $validated['title']) {
            $data['slug'] = $this->generateUniqueSlug(
                $validated['title'],
                $news
            );
        }

        $data['published'] = $request->boolean('published');

        if ($data['published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {

            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('news', 'public');
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'L’actualité a été modifiée avec succès.'
            );
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'L’actualité a été supprimée.'
            );
    }

    public function toggleStatus(News $news)
    {
        if ($news->published) {

            $news->update([
                'published' => false,
            ]);

            $message = 'L’actualité a été dépubliée.';

        } else {

            $news->update([
                'published' => true,
                'published_at' => $news->published_at ?? now(),
            ]);

            $message = 'L’actualité a été publiée.';
        }

        return back()->with('success', $message);
    }

    private function generateUniqueSlug(
        string $title,
        ?News $news = null
    ): string {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 2;

        while (
            News::where('slug', $slug)
                ->when(
                    $news,
                    fn ($query) =>
                        $query->where('id', '!=', $news->id)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}