<?php

namespace App\Http\Controllers\Site;

use App\Mail\ContactEmail;
use App\Models\PageContact;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteContactController extends Controller
{
    public function index()
    {
        $page_contact = PageContact::find($id = 1);
        return view("site.contact.index", compact(['page_contact']));
    }
}
