<?php

use Buglinjo\LaravelWebp\Webp;

function UploadFile($file, $path)
{
    if ($file->getSize() < 16777216) {

        $extension = $file->extension();

        $md5_file =  md5($file->getClientOriginalName() . date("Y-m-d H:i:s"));
        $file_name = $md5_file . ".{$extension}";

        $file->move(public_path($path), $file_name);

        // if ($extension == "png" || $extension == "jpg" || $extension == "webp" || $extension == "jpeg") {
        //     \Tinify\setKey("wJtXcNHkqtXH84pNM6H2bCNrXW6n9rNB");
        //     $source = \Tinify\fromFile(public_path($path) . "/{$file_name}");
        //     $source->toFile(public_path($path) . "/{$file_name}");
        // }
        return $file_name;
    }

    return $error = 1;
}

function UploadImageWithWebp($file, $path)
{


    if ($file->getSize() < 16777216) { // same as 16mb

        $extension = $file->extension();
        $md5_file =  md5($file->getClientOriginalName() . date("Y-m-d H:i:s"));
        $file_name = $md5_file . ".{$extension}";
        $file_name_webp = $md5_file . ".webp";
        $path_webp = public_path($path) . "/{$file_name_webp}";

        if (!is_dir(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }

        $webp = Webp::make($file);
        $webp->save($path_webp);

        $file->move(public_path($path), $file_name);

        // if ($extension == "png" || $extension == "jpg" || $extension == "webp" || $extension == "jpeg") {
        //     \Tinify\setKey("wJtXcNHkqtXH84pNM6H2bCNrXW6n9rNB");
        //     $source = \Tinify\fromFile(public_path($path) . "/{$file_name}");
        //     $source->toFile(public_path($path) . "/{$file_name}");
        // }

        return array($file_name, $file_name_webp);
        // return array($error = 2, $control = false);
    }

    return array($error = 1, $control = false);

    // error 1 = size exceeded the maximum allowed || error 2 = entenxsion not allowed
}
