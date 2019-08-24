<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Hashids;

class LinkController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param $uid
     *
     * @return void
     */
    public function show($uid)
    {
        $id = array_first(Hashids::decode($uid));

        if ($id && $link = Link::find($id)) {
            $link->clicked();

            return redirect($link->url);
        }

        return redirect()->route('home');
    }
}
