<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\City;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class CityController extends Controller
        {

            
            public function index()
            {
                $cities = City::where("status", 1)->get();

                return view("content-adm.dashboard.cities.index", compact(["cities"]));
            }

            public function create()
            {
                return view("content-adm.dashboard.cities.add");
            }

            public function store(Request $request)
            {
                try {
                    $data = $request->all();
                    
            $data["status"] = 1;
            

                    City::create($data);

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
                $city = City::find($id);

                if ($city) {
                    return view("content-adm.dashboard.cities.edit", compact(["city"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    City::findOrFail($request->id)->update($data);

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
                    City::findOrFail($request->id)->update(["status" => 0]);

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
                    if (!City::findOrFail($id)->update(["status" => 0])) {
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
                        $instance = City::find($id);
        
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
        