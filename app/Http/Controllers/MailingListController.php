<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:mailing_lists,email',
        ]);

        MailingList::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Subscribed successfully!');
    }
}
