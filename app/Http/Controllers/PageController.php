<?php

namespace App\Http\Controllers;

use File;

class PageController extends Controller
{
    /**
     * @param $page
     *
     * @return string
     */
    protected function getContent($page)
    {
        return markdown(File::get(resource_path("views/pages/contents/{$page}.md")));
    }

    public function about()
    {
        $content = $this->getContent('about');

        return view('pages.show', compact('content'));
    }

    public function privacy()
    {
        $content = $this->getContent('privacy');

        return view('pages.show', compact('content'));
    }

    public function terms()
    {
        $content = $this->getContent('terms');

        return view('pages.show', compact('content'));
    }
}
