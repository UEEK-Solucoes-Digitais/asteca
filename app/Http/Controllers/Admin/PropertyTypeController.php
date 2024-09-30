<?php

namespace App\Http\Controllers\Admin;

use App\Models\PropertyType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{


    public function index()
    {
        $property_types = PropertyType::where("status", 1)->orderBy("position", "ASC")->get();

        return view("content-adm.dashboard.property_types.index", compact(["property_types"]));
    }

    public function create()
    {
        return view("content-adm.dashboard.property_types.add");
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $data["position"] = 999;

            $data["status"] = 1;


            PropertyType::create($data);

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
        $property_type = PropertyType::find($id);

        if ($property_type) {
            return view("content-adm.dashboard.property_types.edit", compact(["property_type"]));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();


            PropertyType::findOrFail($request->id)->update($data);

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


    public function organizePropertyType(Request $request)
    {
        $new_position = 0;

        foreach ($request->item as $id) {
            PropertyType::findOrFail($id)->update(["position" => $new_position]);
            $new_position++;
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            PropertyType::findOrFail($request->id)->update(["status" => 0]);

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
            if (!PropertyType::findOrFail($id)->update(["status" => 0])) {
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
                $instance = PropertyType::find($id);

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
