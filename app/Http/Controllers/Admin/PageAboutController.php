<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageAbout;
use App\Models\Gallery;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageAboutController extends Controller
{

    public function edit($id = 1)
    {
        $page_about = PageAbout::find($id);
        $gallery = Gallery::where('status', 1)->where('type', 5);
        if ($page_about) {
            return view("content-adm.dashboard.page_about.edit", compact(["page_about", "gallery"]));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                list($data['image'], $data['image_webp']) = UploadImageWithWebp($request->image, "img/uploads/page_about/");

                $validation = ImageHandler($data['image']);
            }

            PageAbout::findOrFail($request->id)->update($data);

            return response()->json([
                "status" => 1,
                "msg" => "Operação realizada com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => 0,
                "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
