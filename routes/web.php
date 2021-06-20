<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
        return view('posts', [
        'posts' => Post::latest()->with('category', 'author')->get()
        //The abovre solves the n + 1 problem
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    //Find a post by its slug and pass it to a view called "post"

    return view('post', [
        'post' =>  $post
    ]);
    
});

Route::get('categories/{category:slug}', function (Category $category) {
        return view('posts', [
        'posts' =>  $category->posts
    ]);
});

Route::get('authors/{author}', function (User $author) {
        return view('posts', [
        'posts' =>  $author->posts
    ]);
});


//find one or more of the preceding charecter, and nothing else === [A-z]+

//All letters dashes and underscores are ok but nothing else [A-z_\-]+

// ->whereAlpha('post') would indicate that it could be upper or lower case letters but nothing else