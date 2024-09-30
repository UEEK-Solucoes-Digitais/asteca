<?php

namespace App\Http\Controllers\Admin;

use App\Models\OurRelease;
use App\Models\PropertyType;

use Illuminate\Http\Request;
use App\Models\ReleaseDifferential;
use App\Http\Controllers\Controller;

class OurReleaseController extends Controller
{


    public function index()
    {
        $our_releases = OurRelease::where("status", 1)->orderBy("position", "ASC")->get();

        return view("content-adm.dashboard.our_releases.index", compact(["our_releases"]));
    }

    public function create()
    {
        $property_types = PropertyType::where("status", 1)->orderBy("position", "ASC")->get();
        return view("content-adm.dashboard.our_releases.add", compact(["property_types"]));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('differentials');

            $data['url'] = friendlyUrl($request->title);
            $data["position"] = 999;
            list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/our-releases/");

            $data["status"] = 1;

            $item = OurRelease::create($data);

            $differentials = $request->differentials;

            foreach ($differentials as $differential) {
                $diff['release_id'] = $item->id;
                $diff['text'] = $differential;
                $diff['status'] = 1;
                $diff['position'] = 999;

                ReleaseDifferential::create($diff);
            }

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


    public function edit($id)
    {
        $our_release = OurRelease::find($id);

        if ($our_release) {
            $differentials = ReleaseDifferential::where('release_id', $our_release->id)->get();
            $property_types = PropertyType::where("status", 1)->orderBy("position", "ASC")->get();

            return view("content-adm.dashboard.our_releases.edit", compact(["our_release", "differentials", 'property_types']));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->except('differentials');
            $data['url'] = friendlyUrl($request->title);

            if ($request->hasFile("image") && $request->file("image")->isValid()) {
                list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/our-releases/");
            }

            OurRelease::findOrFail($request->id)->update($data);

            ReleaseDifferential::where('release_id', $request->id)->delete();

            $differentials = $request->differentials;

            foreach ($differentials as $differential) {

                $diff['release_id'] = $request->id;
                $diff['text'] = $differential;
                $diff['status'] = 1;
                $diff['position'] = 999;

                ReleaseDifferential::create($diff);
            }

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


    public function organizeOurRelease(Request $request)
    {
        $new_position = 0;

        foreach ($request->item as $id) {
            OurRelease::findOrFail($id)->update(["position" => $new_position]);
            $new_position++;
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            OurRelease::findOrFail($request->id)->update(["status" => 0]);

            return response()->json([
                "status" => 1,
                "msg" => "Removido com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => 0,
                "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function updateMultipleStatus(Request $request)
    {

        $validated = true;

        foreach ($request->inputs as $id) {
            if (!OurRelease::findOrFail($id)->update(["status" => 0])) {
                $validated = false;
            }
        }

        if ($validated) {
            return response()->json([
                "status" => 1,
                "msg"    => "Removidos com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "msg"    => "Ocorreu um erro ao remover. Tente novamente mais tarde.",
            ], 500);
        }
    }

    public function copy(Request $request)
    {

        try {
            foreach ($request->inputs as $id) {
                $instance = OurRelease::find($id);

                $new_instance = $instance->replicate();
                $new_instance->created_at = date("Y-m-d H:i:s");
                $new_instance->updated_at = date("Y-m-d H:i:s");
                $new_instance->save();
            }

            return response()->json([
                "status" => 1,
                "msg"    => "Duplicados com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => 0,
                "msg"    => "Ocorreu um erro ao duplicar. Tente novamente mais tarde.",
                "error"    => $e->getMessage(),
            ], 500);
        }
    }
}
