<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('user')->get();
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'id'=>$post->id,
            'slug'=>$post->slug,
            'added_at'=>$post->created_at->diffForHumans(),
            'body'=>$post->body,
            'comments_count'=>$post->comments->count(),
            'image'=>$post->image,
            'user'=>$post->user,
            'category'=>$post->category,
            'comments'=>$this->commentsFormatted($post->comments),
            'title'=>$post->title
        ]);
    }
  public function commentsFormatted($comments)
  {
      $new_comments =[];
      foreach($comments as $comment){
          array_push($new_comments,[
            'id'=>$comment->id,
            'added_at'=>$comment->created_at->diffForHumans(),
            'body'=>$comment->body,
            'user'=>$comment->user
          ]);
      }
      return $new_comments;
  }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function categoryPosts($slug)
    {
       $category = Category::whereSlug($slug)->first();
    //    return $category;
       $posts = Post::whereCategoryId($category->id)->with('user')->get();
    // $posts= DB::table('categories')
    // ->join('posts', 'categories.id','=','posts.category_id')
    // ->where('categories.slug','=','Food')
    // // ->ORDERBY ('posts.updated_at', 'DESC')
    // ->get();
    // return $posts;

       foreach($posts as $post){
        $post->setAttribute('added_at',$post->created_at->diffForHumans());
        $post->setAttribute('comments_count',$post->comments->count());
    }
       return response()->json($posts);
}



}
