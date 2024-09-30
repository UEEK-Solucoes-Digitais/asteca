<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\CookiePolicy;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class CookiePolicyController extends Controller
        {

            

            public function edit($id = 1)
            {
                $cookie_policy = CookiePolicy::find($id);

                if ($cookie_policy) {
                    return view("content-adm.dashboard.cookie_policies.edit", compact(["cookie_policy"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    CookiePolicy::findOrFail($request->id)->update($data);

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
        