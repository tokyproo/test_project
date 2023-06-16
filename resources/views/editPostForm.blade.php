<x-layout>

    
    <div class="container py-md-5 container--narrow">
        <form action="/post/{{$post->id}}/edit" method="POST">
            @csrf
            @method('PUT',$post)
          <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
            <input value="{{$post->title}}"  name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
          </div>
          @error('title')
          <p style="color:red; margin:5px">{{$message}}</p>
          @enderror
  
          <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
            <textarea   name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{$post->body}}</textarea>
          </div>
          @error('body')
          <p style="color:red; margin:5px">{{$message}}</p>
          @enderror
          <button class="btn btn-primary">Save Changes</button>
        </form>
      </div>

</x-layout>