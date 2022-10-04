<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    function list() {
        $contacts = Contact::all();
        return view('admin.contact.list', compact('contacts'));
    }
}
