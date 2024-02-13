<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/blog')->name('blog.')->group(function(){

    Route::get('/', function(){

        // $posts = Post::all(['title', 'id']);



        // $post = Post::findOrFail(4);
        // $post->title = "new title";
        // $post->save();
        // $post->delete();


        // $posts = Post::where('id', '>', 0)->limit(2)->get();

        // dd($posts);

        return Post::paginate(25);


        // $post = new Post();
        // $post->title = "post2";
        // $post->slug = "this is the second post";
        // $post->content = "Harry Potter";
        // $post->save();

        // Or

        // $post = Post::create([
        //     "title" => "post 3",
        //     "slug" => "this is the third post",
        //     "content" => "Jhon Wick"
        // ]);

        // return $post;

        return [
            "link"=> \route('blog.show', ["id" => "30", "title" => "harrypotter"])
        ];


    })->name('index');
    
    
    Route::get('/{title}/{id}', function(string $title, string $id){

        $post = Post::findOrFail($id);
        if($post->title !== $title){
            return to_route('blog.show', ['title' => $post->title, "id" => $post->id]);
        }
        return $post;

    })->name('show');

});



Route::get('/test', function(Request $request){

    /*
        if u are just returing a string the server are going to response as an html content
        if u returning an array its going to be json
    */

    return [
        "parameters" => $request->all(), // this returns all the parameters in the url
        "url" => $request->url(), // this returns the url of ur app
        "path" => $request->path(), // this returns the current route
        "name" => $request->input("name"), // this returns the value of the parameter name that passed in the url if its empty its gonna be null! and u can give it a default value if u want
        "content" => "Hello World!"
    ];
});