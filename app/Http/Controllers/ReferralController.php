<?php

namespace App\Http\Controllers;

use App\Mail\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReferralController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     */
    public function invites(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns|required|unique:users'
        ]);

        Mail::to([
            'email' => $request->email
        ])->send(new Invitation($request->user(), $request->email));


        dd($request->all());
    }
}
