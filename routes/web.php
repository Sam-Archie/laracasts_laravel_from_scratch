<?php

use App\Models\Post;
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

    $files = File::files(resource_path('posts'));

    $posts = [];

    foreach ($files as $file) {
       $document = YamlFrontMatter::parseFile($file);

       $posts[] = new Post(
           $document->title,
           $document->body(),
           $document->date,
           $document->excerpt,
           $document->slug
       );
    }



    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('/posts/{post}', function ($slug) {
    //Find a post by its slug and pass it to a view called "post"
    
    return view('post', [
        'post' => Post::find($slug)
    ]);
    
})->where('post', '[A-z_\-]+');//->whereAlpha('post');
//find one or more of the preceding charecter, and nothing else === [A-z]+

//All letters dashes and underscores are ok but nothing else [A-z_\-]+

// ->whereAlpha('post') would indicate that it could be upper or lower case letters but nothing else