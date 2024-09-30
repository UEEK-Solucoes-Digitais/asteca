<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function edit($type, $item_id)
    {
        // dd($type, $item_id);
        $images = Gallery::where('status', 1)->where('type', $type)->where('item_id', $item_id)->orderBy("position", "ASC")->get();
        return view("content-adm.dashboard.gallery.edit", [
            'images' => $images,
            'type' => $type,
            'item_id' => $item_id,
        ]);
    }

    public function createMultipleImages(Request $request)
    {

        $alt = explode(",", $request->image_alt);

        $validated = true;

        for ($i = 0; $i < $request->image_count; $i++) {

            $data = $request->only('image', 'image_webp', 'alt_text', 'type', 'item_id', 'position');

            $image_name = "image{$i}";

            list($data['image'], $data['image_webp']) = UploadImageWithWebp($request->$image_name, "img/uploads/gallery/");

            $data['alt_text'] = $alt[$i];
            $data['position'] = 0;
            $data['status'] = 1;

            if (!Gallery::create($data)) {

                $validated = false;
            }
        }
        if ($validated) {
            echo json_encode(array(
                'status' => 1,
                'msg'    => 'Adicionado com sucesso!',
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao adicionar. Tente novamente mais tarde.',
            ));
        }
    }

    public function updateGalleryImageAlt(Request $request)
    {
        try {
            $data = $request->all();
            $data['alt_text'] = $request->alt_text ? $request->alt_text : "";

            Gallery::findOrFail($request->id)->update($data);

            echo json_encode(array(
                'status' => 1,
            ));
        } catch (\Throwable $e) {
            echo json_encode(array(
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao alterar. Tente novamente mais tarde.',
                'error' => $e->getMessage(),
            ));
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            Gallery::findOrFail($request->id)->update(['status' => 0]);

            echo json_encode(array(
                'status' => 1,
                'msg'    => 'Removido com sucesso',
            ));
        } catch (\Throwable $e) {
            echo json_encode(array(
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao alterar. Tente novamente mais tarde.',
                'error' => $e->getMessage(),
            ));
        }
    }

    public function organizeGallery(Request $request)
    {
        $new_position = 0;

        foreach ($request->item as $id) {
            Gallery::findOrFail($id)->update(['position' => $new_position]);
            $new_position++;
        }
    }
}
