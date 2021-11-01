@extends('components.layout')

@section('title')
    {!! $post->title!!} 
@endsection


@section('content')
    <h1>
        {{$post->title;}}
    </h1>
    <small>
        {{-- < ?= $post->date ?> --}}
        {{-- < ?php echo $post->date ?> --}}
        {{-- {{ $post->date }} non vengono formattati i tag HTML --}}

        categoria : <a href="/categories/{{ $post->category->slug }}" > {{$post->category->name }} </a>
    </small>
    <p>
        by the author : <a href="/authors/{{ $post->author->username }}"> {{$post->author->name}} </a>
    </p>
        <div class="post_content">
            <?= $post->body ?>
        </div>
    </article>
@endsection