<?php

function UploadFile($file, $path)
{

    $extension = $file->extension();

    $md5_file =  md5($file->getClientOriginalName() . date("Y-m-d H:i:s"));
    $file_name = $md5_file . ".{$extension}";

    $file->move(public_path($path), $file_name);

    return $file_name;
}
