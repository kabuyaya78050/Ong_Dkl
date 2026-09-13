<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->paginate(9);

        return view('news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $article = News::where('slug', $slug)
            ->where('published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
            })
            ->firstOrFail();

        return view('news.show', compact('article'));
    }
}