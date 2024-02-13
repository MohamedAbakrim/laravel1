@extends('base')

@section('title', $post->title)

@section('content')
        <article>
            <h3>{{$post->title}}</h3>
            <p>
                {{$post->content}}
            </p>
        </article>
@endsection