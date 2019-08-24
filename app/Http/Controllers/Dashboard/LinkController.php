<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Profile;
use Hashids;
use Illuminate\Http\Request;

class LinkController extends Controller
{
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
            'order' => optional($profile->links('desc')->first())->order + 1,
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

        $link->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => __('Link Updated!'),
            'data' => $profile->fresh()
        ]);
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
                'message' => __('Link Deleted! '),
                'data' => $profile->fresh()
            ]);
        }
    }
}
