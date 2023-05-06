<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function storeFile(Request $request, $directory, $filename)
    {
        $file = $request->file($filename);
        $file->move(public_path($directory), $file->getClientOriginalName());
        $path = $directory . $file->getClientOriginalName();

        return $path;
    }
}
