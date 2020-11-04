<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show messages on Dashboard
     */
    public function index() {
        return view('contact.index', [
            'messages' => Contact::all(),
        ]);
    }

    /**
     * Show form
     */
    public function show() {
        return view('contact.show');
    }

    /**
     * Submit contact form
     */
    public function store(Request $request) {

        $request->validate([
            'g-recaptcha-response' => ['required', new Recaptcha],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $submission = new Contact([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
        ]);

        $submission->save();

        return redirect( route('contact') )
            ->with('success', 'Thank you for writing us! We have received your message.');

    }

    /**
     * Show message
     */
    public function single($contact_id)
    {
        $contact = Contact::find($contact_id);

        return view('contact.single', [
            'subject' => $contact->subject,
            'sender_name' => $contact->name,
            'sender_email' => $contact->email,
            'message' => $contact->message
        ]);
    }
}
