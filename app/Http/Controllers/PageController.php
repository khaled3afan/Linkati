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
        $title = 'عن لينكاتي';

        return view('pages.show', compact('content', 'title'));
    }

    public function privacy()
    {
        $content = $this->getContent('privacy');
        $title = 'سياسة الخصوصية';

        return view('pages.show', compact('content', 'title'));
    }

    public function terms()
    {
        $content = $this->getContent('terms');
        $title = 'شروط الاستخدام';

        return view('pages.show', compact('content', 'title'));
    }
}
