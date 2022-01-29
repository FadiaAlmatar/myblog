<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        // $this->middleware('admin');
    }
    public function getPosts(){
        $posts = Post::latest()->with('user')->get();
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
        }
        return response()->json($posts);
    }

    public function addPost(Request $request){

         $filename = '';
        if($request->hasFile('image')){
           $filename = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(public_path('img'),$filename);
        }
        // $post =new Post();
        $post = Post::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'body'=>$request->body,
            'category_id'=>$request->category,
            'user_id'=> 1,
            'image'=>$filename
        ]);
        // return($request->title);
        // $post->save();
        // return "here";
        // return "here";
        return response()->json($post);
    }
    public function updatePost(Request $request){
        $post = Post::find($request->id);
         $filename = $post->image;
        if($request->hasFile('image')){
           $filename = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(public_path('img'),$filename);
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->image = $filename != '' ? $filename : $post->image;
        $post->save();
        return response()->json($post);
    }
    public function deletePost(Request $request){
    $post = Post::find($request->id);
    $post->delete();
    return response()->json(['message'=>'deleted']);
    }
}
