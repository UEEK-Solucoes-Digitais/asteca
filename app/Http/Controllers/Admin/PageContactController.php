<?php
namespace App\Http\Controllers\Admin;

use App\Models\PageContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageContactController extends Controller
{

    

    public function edit($id = 1)
    {
        $page_contact = PageContact::find($id);

        if ($page_contact) {
            return view("content-adm.dashboard.page_contact.edit", compact(["page_contact"]));
        } else {
            return redirect()->route("dashboard");
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();
            

            PageContact::findOrFail($request->id)->update($data);

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
