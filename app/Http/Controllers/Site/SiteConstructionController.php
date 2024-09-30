<?php

namespace App\Http\Controllers\Site;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\PageConstruction;
use App\Models\ContactInfo;
use App\Models\Construction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteConstructionController extends Controller
{
    public function index()
    {
        $page_construction = PageConstruction::find($id = 1);
        $constructions = Construction::where('status', 1)->orderBy('position', 'asc')->get();

        return view("site.construction.index", compact(['page_construction', 'constructions']));
    }
}
