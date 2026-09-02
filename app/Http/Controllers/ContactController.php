<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // ── Public ──────────────────────────────────────
    public function index()
    {
        $contactDetail = ContactDetail::singleton();
        return view('contact.index', compact('contactDetail'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('sent', true);
    }

    // ── Admin: inbox ────────────────────────────────
    public function adminIndex()
    {
        $messages = Contact::latest()->paginate(15);
        $unreadCount = Contact::where('is_read', false)->count();
        return view('admin.contacts.index', compact('messages', 'unreadCount'));
    }

    public function adminShow(Contact $contact)
    {
        // mark as read when viewed
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function adminDestroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }

    public function adminToggleRead(Contact $contact)
    {
        $contact->update(['is_read' => ! $contact->is_read]);
        return back()->with('success', $contact->is_read ? 'Marked as read.' : 'Marked as unread.');
    }

    // ── Admin: contact details (singleton settings) ──
    public function editDetails()
    {
        $detail = ContactDetail::singleton();
        return view('admin.contacts.settings', compact('detail'));
    }

    public function updateDetails(Request $request)
    {
        $request->validate([
            'address_line1'    => 'required|string|max:255',
            'address_line2'    => 'required|string|max:255',
            'phone'            => 'required|string|max:40',
            'phone_raw'        => 'required|string|max:30',
            'whatsapp_url'     => 'required|url|max:500',
            'whatsapp_display' => 'required|string|max:100',
            'email'            => 'nullable|email|max:255',
            'hours_weekday'    => 'required|string|max:255',
            'hours_sunday'     => 'required|string|max:255',
            'map_embed_url'    => 'nullable|string|max:2000',
        ]);

        $detail = ContactDetail::singleton();
        $detail->update($request->only([
            'address_line1', 'address_line2', 'phone', 'phone_raw',
            'whatsapp_url', 'whatsapp_display', 'email',
            'hours_weekday', 'hours_sunday', 'map_embed_url',
        ]));

        return redirect()->route('admin.contacts.settings')->with('success', 'Contact details updated. Changes are now live on the website.');
    }
}
