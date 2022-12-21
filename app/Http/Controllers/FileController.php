<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function upload(Request $request){
        $request -> validate(['file' => 'required']);
        $file = request() -> file ->getClientOriginalName();
        $destination = storage_path('uploads/PDf/');
        request() -> file -> move($destination,$file);
        Library ::create(['file'=> $file]);
    }
}
