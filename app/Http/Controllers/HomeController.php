<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $news = News::where('published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('projects', 'news'));
    }
}