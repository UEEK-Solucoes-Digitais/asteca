<?php

namespace App\Http\Controllers\Site;

use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\Gallery;


use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteAboutController extends Controller
{
    public function index()
    {
        $page_about = PageAbout::find($id = 1);
        $gallery = Gallery::where('status', 1)->where('type', 6)->orderBy('position', 'asc')->get();

        return view("site.about.index", compact(['page_about', 'gallery']));
    }
}
