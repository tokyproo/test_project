<x-layout>

    
    <div class="container py-md-5 container--narrow">
        <form action="/create-post" method="POST">
            @csrf
          <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
            <input value="{{old('title')}}"  name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
          </div>
          @error('title')
          <p style="color:red; margin:5px">{{$message}}</p>
          @enderror
  
          <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
            <textarea   name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{old('body')}}</textarea>
          </div>
          @error('body')
          <p style="color:red; margin:5px">{{$message}}</p>
          @enderror
          <button class="btn btn-primary">Save New Post</button>
        </form>
      </div>
asdasd
asdasd
</x-layout>