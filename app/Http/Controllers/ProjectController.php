<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Afficher la liste des projets actifs.
     */
    public function index()
    {
        $projects = Project::query()
            ->where('status', 'active')
            ->latest()
            ->paginate(6);

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Afficher les détails d'un projet actif.
     */
    public function show(string $slug)
    {
        $project = Project::query()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('projects.show', [
            'project' => $project,
        ]);
    }
}