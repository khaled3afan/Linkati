<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile $profile
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if ($profile->user_id == auth()->id()) {
            return view('profiles.edit', compact('profile'));
//            return redirect()->route('profiles.edit', $profile);
        }

        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return response()->json([
            'status' => 200,
            'data' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Profile                   $profile
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:profiles,username,' . $request->user()->id
            ],
        ]);

        if (auth()->id() != $profile->user_id) {
            return abort(403);
        }

        if ( ! empty($request->avatar)) {
            $profile->addMediaFromBase64($request->avatar)->toMediaCollection('avatar');
        }

        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->location = $request->location;
        $profile->bio = $request->bio;
        $profile->save();

        return response()->json([
            'status' => 200,
            'message' => __('Your Profile Has Been Updated!'),
            'data' => $profile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile $profile
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
