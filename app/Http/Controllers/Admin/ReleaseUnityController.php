<?php
namespace App\Http\Controllers\Admin;

use App\Models\ReleaseUnity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReleaseUnityController extends Controller
{

    
    public function index($release_id)
    {
        $unities = ReleaseUnity::where("status", 1)->where('release_id', $release_id)->get();

        return view("content-adm.dashboard.release_unities.index", compact(["unities", "release_id"]));
    }

    public function create($release_id)
    {
        return view("content-adm.dashboard.release_unities.add", compact(["release_id"]));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            
            list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/unities/");
        
            $data["status"] = 1;
    

            ReleaseUnity::create($data);

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
        $unit = ReleaseUnity::find($id);

        if ($unit) {
            return view("content-adm.dashboard.release_unities.edit", compact(["unit"]));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();
            
            if ($request->hasFile("image") && $request->file("image")->isValid()) {
                list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/unities/");
            }
        

            ReleaseUnity::findOrFail($request->id)->update($data);

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

    
    public function updateStatus(Request $request)
    {
        try {
            ReleaseUnity::findOrFail($request->id)->update(["status" => 0]);

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
            if (!ReleaseUnity::findOrFail($id)->update(["status" => 0])) {
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
                $instance = ReleaseUnity::find($id);

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
    