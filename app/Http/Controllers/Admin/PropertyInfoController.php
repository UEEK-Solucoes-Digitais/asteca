<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\PropertyInfo;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class PropertyInfoController extends Controller
        {

            

            public function edit($id)
            {
                $property_info = PropertyInfo::find($id);

                if ($property_info) {
                    return view("content-adm.dashboard.properties_infos.edit", compact(["property_info"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    PropertyInfo::findOrFail($request->id)->update($data);

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
        