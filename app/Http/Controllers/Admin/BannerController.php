<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)->orderBy('position')->get();

        return view("content-adm.dashboard.banners.index", compact(['banners']));
    }

    public function create()
    {
        return view("content-adm.dashboard.banners.add");
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['position'] = 999;
            $data['status'] = 1;

            list($data['image'], $data['image_webp']) = UploadImageWithWebp($request->image, "img/uploads/banners/");
            $data['logo'] = UploadFile($request->logo, "img/uploads/banners/");

            $data['logo_webp'] = "";

            $validation = ImageHandler($data['image']);

            if ($validation === true) {

                Banner::create($data);

                return response()->json([
                    'status' => 1,
                    'msg' => "Operação realizada com sucesso!",
                ], 200);
            }

            return response()->json([
                'status' => 0,
                'msg' => $validation,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $banner = Banner::find($id);

        if ($banner) {
            return view("content-adm.dashboard.banners.edit", compact(['banner']));
        } else {
            return redirect('/content-adm/dashboard');
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                list($data['image'], $data['image_webp']) = UploadImageWithWebp($request->image, "img/uploads/banners/");

                $validation = ImageHandler($data['image']);
            }
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $data['logo'] = UploadFile($request->logo, "img/uploads/banners/");

                $validation = ImageHandler($data['logo']);
            }

            if (isset($validation) && $validation != true) {

                return response()->json([
                    'status' => 0,
                    'msg' => $validation,
                ], 200);
            }

            Banner::findOrFail($request->id)->update($data);

            return response()->json([
                'status' => 1,
                'msg' => "Operação realizada com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateStatus(Request $request)
    {
        try {
            Banner::findOrFail($request->id)->update(['status' => 0]);

            return response()->json([
                'status' => 1,
                'msg' => "Removido com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateMultipleStatus(Request $request)
    {

        $validated = true;

        foreach ($request->inputs as $id) {
            if (!Banner::findOrFail($id)->update(['status' => 0])) {
                $validated = false;
            }
        }

        if ($validated) {
            return response()->json([
                'status' => 1,
                'msg'    => 'Removidos com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao remover. Tente novamente mais tarde.',
            ], 500);
        }
    }

    public function copy(Request $request)
    {

        try {
            foreach ($request->inputs as $id) {
                $instance = Banner::find($id);

                $new_instance = $instance->replicate();
                $new_instance->created_at = date('Y-m-d H:i:s');
                $new_instance->updated_at = date('Y-m-d H:i:s');
                $new_instance->save();
            }

            return response()->json([
                'status' => 1,
                'msg'    => 'Duplicados com sucesso!',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao duplicar. Tente novamente mais tarde.',
                'error'    => $e->getMessage(),
            ], 500);
        }
    }

    public function organizeBanner(Request $request)
    {
        $new_position = 0;

        foreach ($request->item as $id) {
            Banner::findOrFail($id)->update(['position' => $new_position]);
            $new_position++;
        }
    }
}
