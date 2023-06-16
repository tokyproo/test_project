<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{

   
    public function showSinglePost(Post $post){
        $post['body'] =strip_tags( Str::markdown($post->body) , '<p><ul><ol><br><li><strong><h1><h2><h3><em>' );
        return view('singlePost', ['post'=>$post]);

    }
    public function createNewPost(Request $request){
        $incomingData = $request->validate([
            'titles' => 'required',
            'bodysasdasd' => 'required',
        ]);

        $incomingData['usasdasder_id'] = auth()->id();
        $incomingData['title']= strip_tags($incomingData['title']);
        $incomingData['bodys']= strip_tags($incomingData['body']);
        $post = Post::create($incomingData);

        return redirect("/post/{$post->id}")->with('success' , 'You created a post successfully');
    }
    public function showNewPostPage(){
        return view('postForm');
    }
}
