@extends('components.layout')

@section('content')
{{--  --}}
    @if(isset($posts))
        @foreach ($posts as $post)
            <article class="{{ $loop->even ? 'even' : 'odd' }}">
                <h1>
                    <a href="/posts/{{ $post->slug }} ">
                        {!! $post->title!!}
                    </a>
                </h1>
                
                <div>
                    <p>
                        by the user : <a href="/users/{{$post->user->username}}"> {{$post->user->name}} </a>
                        <br>
                        category : <a href="/categories/{{ $post->category->slug }}" > {{$post->category->name }} </a>
                    </p>

                    <h2>{!! $post->summary !!}</h2>
                    
                    <p>
                        {{$post->body;}}
                        <br>
                    </p>
                </div>
                
            </article>
        @endforeach
    @else
    No Records Found 
    @endif

    
@endsection


    {{-- <section class="article">
        <h2> 
            <a href="/posts/my-first-post"> Post #1, daje!</a>
        </h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur ad, veritatis unde saepe rem ducimus velit totam debitis quibusdam illo voluptatibus, excepturi aliquam ullam! Assumenda voluptate ab sit sunt necessitatibus?</p>

        <a href="/home">Go back home -> </a>
    </section>
    <section class="article">
        <h2> 
            <a href="/posts/my-second-post"> Post #2, daje!</a>
        </h2>
        <ul>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore modi non, off
            </li>
            <li>
                icia quae natus vitae nisi maxime suscipit tenetur reiciendis dolore aperiam reprehenderit.
            </li>
            <li>
                Ullam facilis odit at alias praesentium cum?
            </li>
        </ul>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam animi nulla tempore provident magni ipsa veritatis? Est explicabo, ipsa soluta molestias et cupiditate provident doloremque. Dolor provident veniam vitae soluta.
        </p>
    </section>
    <section class="article">
        <h2> 
            <a href="/posts/my-third-post"> Post #3, daje!</a>
        </h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto quidem facere repellat et aliquid suscipit veritatis magni adipisci similique commodi illo, cum ea distinctio accusamus facilis. Enim veritatis velit voluptate?</p>
    <section/> --}}