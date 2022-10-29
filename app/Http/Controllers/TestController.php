<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function index(){
     return view('test.test');
   }

   public function upload(Request $request){
            // return $request->image;
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
             ]);

            $fileUpload = new FileUpload;
            if($request->file()){
               $fileName = time().'-' . $request->file->getClientOriginalName();
               $filePath = $request->file('file')->storeAs('uploads',$fileName, 'public');

               $fileUpload->name =  time().'-' . $request->file->getClientOriginalName();
               $fileUpload->path = '/storage/' . $filePath;

               $fileUpload->save();
               return response()->json(['success'=>'File uploaded successfully.']);
            }
   }

   public function getImage(){
           $images = FileUpload::get();

           return response()->json($images);
   }
}
