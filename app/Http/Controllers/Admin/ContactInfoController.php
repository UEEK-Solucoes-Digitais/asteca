<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\ContactInfo;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class ContactInfoController extends Controller
        {

            

            public function edit($id = 1)
            {
                $contact_info = ContactInfo::find($id);

                if ($contact_info) {
                    return view("content-adm.dashboard.contact_info.edit", compact(["contact_info"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    

                    ContactInfo::findOrFail($request->id)->update($data);

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
        