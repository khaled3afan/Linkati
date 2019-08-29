<?php

namespace App\Http\Controllers;

use App\Mail\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReferralController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invites(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'email:rfc,dns|required|unique:users'
            ],
            [
                'unique' => 'البريد الالكتروني الذي تحاول دعوته موجود مسبقا!',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->with(['script' => '$("#referrals").modal("show");'])
                ->withErrors($validator)
                ->withInput();
        }

        Mail::to(['email' => $request->email])
            ->send(new Invitation($request->user(), $request->email));

        return back()->with('status', 'شكرًا لك، تم ارسال الدعوة بنجاح!');
    }
}
