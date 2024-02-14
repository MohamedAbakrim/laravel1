<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\PostFormRequest;
use App\Models\Post;
// use Illuminate\Validation\Rule;




class PostController extends Controller
{
    //

    public function index(){


        // BlogFilterRequest $request;
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



    public function create(){
        $post = new Post();
        return view('blog.create', [
            "post" => $post
        ]);
    }

    public function store(PostFormRequest $request){

        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ["title" => $post->title, "post"=> $post->id])->with('done', "the post has been saved successfully");
    }

    public function edit(Post $post){
        return view('blog.edit', [
            "post" => $post
        ]);
    }



    public function update(PostFormRequest $request, Post $post){
        $post->update($request->validated());
        return redirect()->route('blog.show', ["title" => $post->title, "post"=> $post->id])->with('done', "the post has been updated successfully");
    }
}
