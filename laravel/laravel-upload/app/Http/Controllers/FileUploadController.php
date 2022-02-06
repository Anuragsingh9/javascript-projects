<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request) {
        $file = $request->file;
        $path = $file->storeAs('bucket',time().$file->getClientOriginalName());
        if ($path){
            $uploaded = FileUpload::create(['file_url' => $path ]);
        }
        return view('index')->with('message',$file->getClientOriginalName().time() ."uploaded Successfully");
    }
}
