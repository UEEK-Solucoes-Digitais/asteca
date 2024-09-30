<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\PageConstruction;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class PageConstructionController extends Controller
        {

            

            public function edit($id = 1)
            {
                $page_construction = PageConstruction::find($id);

                if ($page_construction) {
                    return view("content-adm.dashboard.page_constructions.edit", compact(["page_construction"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    PageConstruction::findOrFail($request->id)->update($data);

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
        