<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = Volunteer::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $volunteers = $query
            ->paginate(15)
            ->withQueryString();

        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function accept(Volunteer $volunteer)
    {
        $volunteer->update([
            'status' => 'accepted',
        ]);

        return back()->with(
            'success',
            'La candidature a été acceptée.'
        );
    }

    public function reject(Volunteer $volunteer)
    {
        $volunteer->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'La candidature a été refusée.'
        );
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return redirect()
            ->route('admin.volunteers.index')
            ->with(
                'success',
                'La candidature a été supprimée.'
            );
    }
}