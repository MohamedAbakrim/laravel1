@extends('base')

@section('title', 'Home')

@section('content')
    <h1>my Blogs</h1>



    @forelse($posts as $post)
        <article class="border rounded p-3 bg-light">
            <h3>{{$post->title}}</h3>
            <p class="small">
                @if($post->category)
                    Category : <strong>{{ $post->category?->name }}</strong>
                @endif

                @if(!$post->tags->isEmpty())
                    , Tags :
                    @foreach($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>
            <img style="width:100%;height:200px;object-fit:cover" src="{{$post->imageUrl()}}" alt="image"/>
            <p>
                {{$post->content}}
            </p>
            <p>
                <a href="{{route('blog.show', ['title'=> $post->title, 'post'=> $post->id])}}" class="btn btn-primary">Read more</a>
            </p>
        </article>
    @empty
        <p>No Posts</p>
    @endforelse
    
    {{$posts->links()}}
@endsection