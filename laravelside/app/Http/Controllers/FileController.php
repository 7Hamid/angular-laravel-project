<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FileController extends Controller
{
    //
    public function file(Request $request){
        $post=new Post;
        if($request->hasFile('image')){
           $completeFileName=$request->file('image')->getClientOriginalName();
           $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
           $extension=$request->file('image')->getClientOriginalExtension();
           $compPic=str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
           $path=$request->file('image')->storeAs('public/posts',$compPic);
           $post->image=$compPic;
        }
        if($post->save()){
            return ['status'=>true,'message'=>'Image Saved Successfully'];
        }
        else{
            return ['status'=>false,'message'=>'Something Went Wrong'];
        }
    }
}
