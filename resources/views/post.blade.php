<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>My Blog</title>
</head>
<body>
    <h1>Hello World</h1>
    <article>
        <h1>{!! $post->title !!}</h1> 
        <p>
           By <a href="authors/">{{ $post->author->username }}</a> In <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            
        </p>

        <div>
            {!! $post->body !!}
        </div>

    </article>

    <a href="/">Go Back</a>
</body>
</html>