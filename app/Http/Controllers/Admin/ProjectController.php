<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'goal_amount' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                'in:draft,active,completed',
            ],
        ]);

        $data = $validated;

        $data['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );

        $data['collected_amount'] = 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        }

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with(
                'success',
                'Le projet a été créé avec succès.'
            );
    }

    public function edit(Project $project)
    {
        return view(
            'admin.projects.edit',
            compact('project')
        );
    }

    public function update(
        Request $request,
        Project $project
    ) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'goal_amount' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                'in:draft,active,completed',
            ],
        ]);

        $data = $validated;

        if ($project->title !== $validated['title']) {
            $data['slug'] = $this->generateUniqueSlug(
                $validated['title'],
                $project
            );
        }

        if ($request->hasFile('image')) {

            if ($project->image) {
                Storage::disk('public')->delete(
                    $project->image
                );
            }

            $data['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with(
                'success',
                'Le projet a été modifié avec succès.'
            );
    }

    public function destroy(Project $project)
    {
        if (
            $project->donations()
                ->where('status', 'confirmed')
                ->exists()
        ) {
            return back()->with(
                'error',
                'Ce projet possède des dons confirmés. '
                . 'Il ne peut pas être supprimé.'
            );
        }

        if ($project->image) {
            Storage::disk('public')->delete(
                $project->image
            );
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with(
                'success',
                'Le projet a été supprimé.'
            );
    }

    public function toggleStatus(Project $project)
    {
        if ($project->status === 'active') {
            $project->update([
                'status' => 'draft',
            ]);
        } else {
            $project->update([
                'status' => 'active',
            ]);
        }

        return back()->with(
            'success',
            'Le statut du projet a été mis à jour.'
        );
    }

    private function generateUniqueSlug(
        string $title,
        ?Project $project = null
    ): string {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 2;

        while (
            Project::where('slug', $slug)
                ->when(
                    $project,
                    fn ($query) =>
                        $query->where('id', '!=', $project->id)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}