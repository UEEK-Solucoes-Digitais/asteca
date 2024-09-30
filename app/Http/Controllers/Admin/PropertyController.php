<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Property;
use App\Models\Neighborhood;
use App\Models\PropertyInfo;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{


    public function index()
    {
        $properties = Property::where("status", 1)->orderBy("position", "ASC")->get();

        return view("content-adm.dashboard.properties.index", compact(["properties"]));
    }

    public function create()
    {

        $cities = City::where('status', 1)->get();
        $neighborhoods = Neighborhood::where('status', 1)->get();
        $property_types = PropertyType::where("status", 1)->orderBy("position", "ASC")->get();

        return view("content-adm.dashboard.properties.add", compact(['cities', 'neighborhoods', 'property_types']));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('infos_title', 'infos_value');

            $data['price'] = str_replace(',', '.', str_replace('.', '', $request->price));

            $titles = $request->infos_title;
            $values = $request->infos_value;

            list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/properties/");

            $data["position"] = 999;
            $data['url'] = friendlyUrl($request->title);

            $data["status"] = 1;

            $item = Property::create($data);

            if (count($titles) > 0) {
                for ($i = 0; $i < count($titles); $i++) {
                    if ($titles[$i] && $values[$i]) {

                        $info['info_title'] = $titles[$i];
                        $info['info_value'] = str_replace(',', '.', str_replace('.', '', $values[$i]));
                        $info['property_id'] = $item->id;

                        PropertyInfo::create($info);
                    }
                }
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
        $property = Property::find($id);

        if ($property) {
            $infos = PropertyInfo::where('property_id', $property->id)->get();

            $cities = City::where('status', 1)->get();
            $neighborhoods = Neighborhood::where('status', 1)->get();
            $property_types = PropertyType::where("status", 1)->orderBy("position", "ASC")->get();

            return view("content-adm.dashboard.properties.edit", compact(["property", 'infos', 'cities', 'neighborhoods', 'property_types']));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->except('infos_title', 'infos_value');
            $titles = $request->infos_title;
            $values = $request->infos_value;

            $data['price'] = str_replace(',', '.', str_replace('.', '', $request->price));

            if ($request->hasFile("image") && $request->file("image")->isValid()) {
                list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/properties/");
            }
            $data['url'] = friendlyUrl($request->title);

            PropertyInfo::where('property_id', $request->id)->delete();

            if (count($titles) > 0) {
                for ($i = 0; $i < count($titles); $i++) {
                    if ($titles[$i] && $values[$i]) {
                        $info['info_title'] = $titles[$i];
                        $info['info_value'] = str_replace(',', '.', str_replace('.', '', $values[$i]));
                        $info['property_id'] = $request->id;

                        PropertyInfo::create($info);
                    }
                }
            }

            Property::findOrFail($request->id)->update($data);

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


    public function organizeProperty(Request $request)
    {
        $new_position = 0;

        foreach ($request->item as $id) {
            Property::findOrFail($id)->update(["position" => $new_position]);
            $new_position++;
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            Property::findOrFail($request->id)->update(["status" => 0]);

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
            if (!Property::findOrFail($id)->update(["status" => 0])) {
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
                $instance = Property::find($id);

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
