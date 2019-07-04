<?php

namespace App\Http\Controllers;

use App\Link;
use App\Profile;
use Illuminate\Http\Request;

class LinkController extends Controller
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
     * @param Profile                   $profile
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'name' => 'required',
            'url' => 'required|url',
        ]);

        if (auth()->id() != $profile->user_id) {
            return abort(403);
        }

        $profile->links()->save(new Link([
            'user_id' => $profile->user_id,
            'name' => $request->name,
            'url' => $request->url,
            'order' => optional($profile->links()->latest()->first())->order + 1,
            'type' => Link::TYPE_NORMAL,
        ]));

        return response()->json([
            'status' => 200,
            'message' => __('Link Created!'),
            'data' => $profile->fresh()
        ]);
    }

    /**
     * @param Request $request
     * @param Profile $profile
     * @param Link    $link
     *
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function resort(Request $request, Profile $profile, Link $link)
    {
        if (auth()->id() != $profile->user_id) {
            return abort(403);
        }

        $request->validate([
            'links' => 'required'
        ]);

        foreach ($request->links as $sort => $link) {
            $link = Link::find($link['id']);
            if ($link && $link->user_id == auth()->id()) {
                $link->order = $sort;
                $link->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => __('Link Resorted!'),
            'data' => $profile->fresh()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Profile                   $profile
     * @param Link                      $link
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile, Link $link)
    {
        if (auth()->id() != $profile->user_id) {
            return abort(403);
        }

        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @param Link    $link
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Profile $profile, Link $link)
    {
        if (auth()->id() != $profile->user_id) {
            return abort(403);
        }

        if ($link->delete()) {
            return response()->json([
                'status' => 200,
                'message' => __('Link Deleted!'),
                'data' => $profile->fresh()
            ]);
        }
    }
}
