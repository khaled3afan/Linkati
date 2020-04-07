<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Profile $profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Profile $profile)
    {
        $profile->viewed();

        return view('profiles.show', compact('profile'));
    }

}
