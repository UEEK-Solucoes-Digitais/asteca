<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\Si9Controller;
use App\Models\Gallery;
use App\Models\Banner;

use App\Models\PageHome;
use App\Models\PageAbout;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Construction;
use App\Models\PageConstruction;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SiteHomeController extends Controller
{
    public function Index()
    {
        $page_home = PageHome::find(1);
        $banners = Banner::where('status', 1)->orderBy('position')->get();
        $page_about = PageAbout::first();
        $images = Gallery::where('status', 1)->where('type', 5)->orderBy('position', 'asc')->get();
        $properties = Property::where('status', 1)->orderBy('position', 'asc')->limit(6)->get();

        $page_construction = PageConstruction::find($id = 1);
        $constructions = Construction::where('status', 1)->orderBy('position', 'asc')->limit(4)->get();

        return view("site.home.index", compact(['page_home', 'banners', 'page_about', 'images', 'properties', 'page_construction', 'constructions']));
    }

    public function getBanner(Request $request)
    {
        $banner = Banner::find($request->id);

        return response()->json(['banner' => $banner], 200);
    }

    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => 'Erro na validação de campos',
                $validator->errors()
            ], 422);
        }

        $user = array();
        $user['email'] = $request->email;
        $user['name'] = $request->name;
        $user['phone'] = $request->phone;
        $user['message'] = $request->message;

        if (Mail::send(new ContactEmail($user)) && Si9Controller::registerLead($user)) {
            return response()->json([
                'status' => 1,
                'title' => "Contato enviado com sucesso!",
                'msg' => "Fique atento ao seu e-mail. Entraremos em contato por lá!",
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'title' => "Não foi possível enviar seu formulário",
                'msg' => "Ocorreu um erro interno ao enviar seu e-mail. Já estamos trabalhando nisso, tente novamente mais tarde.",
            ], 500);
        }
    }
}
