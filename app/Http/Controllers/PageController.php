<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MadWeb\Robots\Robots;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Page;

class PageController extends Controller
{
    public function index($path = '/')
    {
        $page = Page::wherePath($path)->first();
        if ($page !== null) {
            return view('pages.page', [
                'page' => $page
            ]);
        } else {
            return response()->view('pages.404', [], 404);
        }
    }
    public function admin()
    {
        return view('layouts.admin');
    }
    public function robots(Robots $robots)
    {
        $robots->addUserAgent('*');

        if ($robots->shouldIndex()) {
            // If on the live server, serve a nice, welcoming robots.txt.
            $robots->addDisallow('/admin');
            $robots->addSitemap(url('sitemap.xml'));
        } else {
            // If you're on any other server, tell everyone to go away.
            $robots->addDisallow('/');
        }

        return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
    }

    public static function generateSitemp($pages, $sitemap, $priority)
    {
        foreach ($pages as $key => $value) {
            $sitemap->add(Url::create($value->path)
                ->setLastModificationDate($value->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority($priority));

            if (isset($value->children) && $value->children->count() > 0) {
                $priority -= 0.1;
                self::generateSitemp($value->children, $sitemap, $priority);
            }
        }
    }
    public function sitemap()
    {
        $priority = 1;
        $sitemap = Sitemap::create();
        self::generateSitemp(Page::get()->toTree(), $sitemap, $priority);
        $sitemap->writeToFile(public_path('sitemap.xml'));
        return response()->json('Success updated!', 200);
    }
}
