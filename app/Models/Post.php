<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    use HasFactory;

    public $date;
    public $excerpt;
    public $title;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->date = $date;
        $this->slug = $slug;
    }

    public static function find($slug)
    {
       return static::all()->firstWhere('slug', $slug);
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            $files = File::files(resource_path('posts'));
            $posts = collect($files)
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
    
            ->map(fn ($document) =>
            new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ))
    
            ->sortByDesc('date');
    
            return $posts;
        });
    }
}
