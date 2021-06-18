<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    use HasFactory;

    public $date;
    public $excerpt;
    public $title;
    public $body;

    public function __construct($title, $excerpt, $date, $body)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->date = $date;
    }

    public static function find(string $slug)
    {
        if (! file_exists($path = resource_path('posts/' . $slug . '.html'))) {
            throw new ModelNotFoundException();
        }
        return cache()->remember("posts.{$slug}", now()->addMinutes(20), fn () => file_get_contents($path));
    }

    public static function all()
    {
        $files = File::files(resource_path('posts'));

        return array_map(fn($file) => $file->getContents(), $files);
    }
}
