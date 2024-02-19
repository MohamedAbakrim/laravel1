<form action="" method="POST">
    @csrf
    @method($post->id ? "PATCH" : "POST")
    <div class="mb-3 mt-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{old('title', $post->title)}}">
        @error('title')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea class="form-control" id="content" placeholder="Enter content" name="content">{{old('content', $post->content)}}</textarea>
        
        @error('content')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category:</label>
        <select class="form-control" id="category" name="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) === $category->id) value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        
        @error('category_id')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>
    @php
        $tagsIds = $post->tags()->pluck('id');
    @endphp
    <div class="mb-3">
        <label for="tag" class="form-label">Tags :</label>
        <select class="form-control" id="tag" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
        
        @error('tags')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        @if($post->id)
            Edit
        @else
            Add
        @endif
    </button>
</form>