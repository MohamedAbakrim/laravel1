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
    <button type="submit" class="btn btn-primary">Submit</button>
</form>