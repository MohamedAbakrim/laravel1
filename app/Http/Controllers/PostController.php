<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rule;




class PostController extends Controller
{
    //

    public function index(){


        // BlogFilterRequest $request;
        // dd($validate->errors());
        // dd($request->validated());

        // $posts = Post::all();

        // $posts = Post::with('category')->get();
        // foreach($posts as $post){
        //     $post->category->name;
        // }


        // $category = Category::find(1);



        // $post = Post::find(2);
        // $post->tags()->createMany([
        //     ['name' => 'Tag 1'],
        //     ['name' => 'Tag 2']
        // ]);
        // dd($post->tags);


        // $post->category()->associate($category);
        // $post->save();
        // dd($category->posts);
        // $category->posts()->where('id', '>', '1')->get();


        // User::create([
        //     "name" => "CmdPy",
        //     "email" => "mohammedabakrim@gmail.com",
        //     "password" => Hash::make('typingclub')
        // ]);
        
        
        return view('blog.index' , [
            "posts" => Post::with('tags', 'category')->paginate(10)
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
            "post" => $post,
            "categories"=>Category::select('id', 'name')->get(),
            "tags" => Tag::select('id', 'name')->get()
        ]);
    }

    public function store(PostFormRequest $request){

        $post = Post::create($this->extractData($request, new Post()));
        $post->tags()->sync($request->validated("tags"));
        return redirect()->route('blog.show', ["title" => $post->title, "post"=> $post->id])->with('done', "the post has been saved successfully");
    }

    public function edit(Post $post){
        return view('blog.edit', [
            "post" => $post,
            "categories"=>Category::select('id', 'name')->get(),
            "tags" => Tag::select('id', 'name')->get()
        ]);
    }

    private function extractData(PostFormRequest $request, Post $post){

        $data = $request->validated();
        $image = $request->validated('image');
        if($image === null || $image->getError()){
            return $data;
        }
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $data['image'] = $image->store('blog', 'public');
        return $data;
    }

    public function update(PostFormRequest $request, Post $post){

        $post->update($this->extractData($request, $post));
        $post->tags()->sync($request->validated("tags"));
        return redirect()->route('blog.show', ["title" => $post->title, "post"=> $post->id])->with('done', "the post has been updated successfully");
    }
}
