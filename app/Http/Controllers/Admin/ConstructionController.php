<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\Construction;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class ConstructionController extends Controller
        {

            
            public function index()
            {
                $constructions = Construction::where("status", 1)->orderBy("position", "ASC")->get();

                return view("content-adm.dashboard.constructions.index", compact(["constructions"]));
            }

            public function create()
            {
                return view("content-adm.dashboard.constructions.add");
            }

            public function store(Request $request)
            {
                try {
                    $data = $request->all();
                    
                list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/constructions/");
                
            $data["position"] = 999;
            
            $data["status"] = 1;
            

                    Construction::create($data);

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
                $construction = Construction::find($id);

                if ($construction) {
                    return view("content-adm.dashboard.constructions.edit", compact(["construction"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    
                if ($request->hasFile("image") && $request->file("image")->isValid()) {
                    list($data["image"], $data["image_webp"]) = UploadImageWithWebp($request->image, "img/uploads/constructions/");
                }
                

                    Construction::findOrFail($request->id)->update($data);

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

            
            public function organizeConstruction(Request $request)
            {
                $new_position = 0;

                foreach ($request->item as $id) {
                    Construction::findOrFail($id)->update(["position" => $new_position]);
                    $new_position++;
                }
            }
            
            public function updateStatus(Request $request)
            {
                try {
                    Construction::findOrFail($request->id)->update(["status" => 0]);

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
                    if (!Construction::findOrFail($id)->update(["status" => 0])) {
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
                        $instance = Construction::find($id);
        
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
        