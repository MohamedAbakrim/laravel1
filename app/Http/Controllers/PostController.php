<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Validation\Rule;




class PostController extends Controller
{
    //

    public function index(BlogFilterRequest $request){

        // dd($validate->errors());
        // dd($request->validated());
        
        return view('blog.index' , [
            "posts" => Post::paginate(2)
        ]);
    }

    public function show(string $title, Post $post){

        if($post->title !== $title){
            return to_route('blog.show', ['title' => $post->title, "id" => $post->id]);
        }
        return view('blog.show', [
            "post" => $post
        ]);
    }

}
