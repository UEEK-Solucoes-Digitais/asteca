<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\Category;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class CategoryController extends Controller
        {

            

            public function edit($id)
            {
                $category = Category::find($id);

                if ($category) {
                    return view("content-adm.dashboard.categories.edit", compact(["category"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    Category::findOrFail($request->id)->update($data);

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
        