<x-layout>
    @foreach ($posts as $post)
    {{-- @dd($loop); --}}
    {{-- //This variable is extremely useful, look into what you can access for instance the class below that is commented out --}}
        <article class="{{-- $loop->even?'class-x': '' --}}"> {{-- access to the odd/even attribut allows us to put a class on every even number --}}
            <h1>
                <a href="posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
            </h1>
            <div>
                {{ $post->excerpt }}
            </div>

        </article>
    @endforeach
</x-layout>
