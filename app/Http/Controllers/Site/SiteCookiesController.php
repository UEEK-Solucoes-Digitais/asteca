<?php

namespace App\Http\Controllers\Site;

use App\Models\CookiePolicy;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteCookiesController extends Controller
{
    public function index()
    {
        $cookie_policy = CookiePolicy::find($id = 1);

        return view("site.legal.index", compact(['cookie_policy']));
    }
}
