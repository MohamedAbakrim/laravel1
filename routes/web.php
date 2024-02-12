<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        return [
            "link"=> \route('blog.show', ["id" => "30", "title" => "harrypotter"])
        ];
    })->name('index');
    
    
    Route::get('/{title}/{id}', function(string $title, string $id){
        return [
            "id" => $id,
            "title"=>$title
        ];
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