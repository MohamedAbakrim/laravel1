<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;



class PostController extends Controller
{
    //

    public function index(){
        return Post::paginate(25);
    }

    public function show(string $title, string $id){
        $post = Post::findOrFail($id);
        if($post->title !== $title){
            return to_route('blog.show', ['title' => $post->title, "id" => $post->id]);
        }
        return $post;
    }

}
