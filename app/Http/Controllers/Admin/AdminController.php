<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::where('status', 1)->get();

        return view("content-adm.dashboard.admins.index", compact(['admins']));
    }

    public function create()
    {
        return view("content-adm.dashboard.admins.add");
    }

    public function store(Request $request)
    {
        try {
            $admin = new Admin();

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->status = 1;

            $admin->save();

            return response()->json([
                'status' => 1,
                'msg' => "Operação realizada com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        if ($admin) {
            return view("content-adm.dashboard.admins.edit", compact(['admin']));
        } else {
            return redirect('/content-adm/dashboard');
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->except(['password', 'confirm_password']);

            if ($request->password != "") {
                $data['password'] = Hash::make($request->password);
            }

            Admin::findOrFail($request->id)->update($data);

            return response()->json([
                'status' => 1,
                'msg' => "Operação realizada com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateStatus(Request $request)
    {
        try {
            Admin::findOrFail($request->id)->update(['status' => 0]);

            return response()->json([
                'status' => 1,
                'msg' => "Removido com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateMultipleStatus(Request $request)
    {

        $validated = true;

        foreach ($request->inputs as $id) {
            if (!Admin::findOrFail($id)->update(['status' => 0])) {
                $validated = false;
            }
        }

        if ($validated) {
            return response()->json([
                'status' => 1,
                'msg'    => 'Removidos com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao remover. Tente novamente mais tarde.',
            ], 500);
        }
    }

    public function copy(Request $request)
    {

        try {
            foreach ($request->inputs as $id) {
                $instance = Admin::find($id);

                $new_instance = $instance->replicate();
                $new_instance->created_at = date('Y-m-d H:i:s');
                $new_instance->updated_at = date('Y-m-d H:i:s');
                $new_instance->save();
            }

            return response()->json([
                'status' => 1,
                'msg'    => 'Duplicados com sucesso!',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao duplicar. Tente novamente mais tarde.',
                'error'    => $e->getMessage(),
            ], 500);
        }
    }
}
