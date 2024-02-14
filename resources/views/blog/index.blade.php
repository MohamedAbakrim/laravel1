@extends('base')

@section('title', 'Home')

@section('content')
    <h1>my Blogs</h1>



    @foreach($posts as $post)
        <article>
            <h3>{{$post->title}}</h3>
            <p>
                {{$post->content}}
            </p>
            <p>
                <a href="{{route('blog.show', ['title'=> $post->title, 'post'=> $post->id])}}" class="btn btn-primary">Read more</a>
            </p>
        </article>
    @endforeach
    
    {{$posts->links()}}
@endsection