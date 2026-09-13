<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();

        if ($request->filled('read')) {
            $query->where('read', $request->read);
        }

        $contacts = $query
            ->paginate(15)
            ->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        // Le message devient automatiquement lu
        if (! $contact->read) {
            $contact->update([
                'read' => true,
            ]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsUnread(Contact $contact)
    {
        $contact->update([
            'read' => false,
        ]);

        return back()->with(
            'success',
            'Le message a été marqué comme non lu.'
        );
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with(
                'success',
                'Le message a été supprimé.'
            );
    }
}