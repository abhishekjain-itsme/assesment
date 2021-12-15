<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        $content = File::get($filename);
        dd($content);
        return back()->with('success','You have successfully upload file.')->with('file', $fileName);
    }
}
