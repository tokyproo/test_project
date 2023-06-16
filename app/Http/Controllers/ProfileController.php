<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function editPost(Post $post, Request $request){

        $incomingData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingData['title'] = strip_tags($incomingData['title']);
        $incomingData['body']= strip_tags($incomingData['body']);

        $post->update($incomingData);

        return redirect('/profile-posts/'.auth()->user()->username)->with('success', 'The post has been updated');

    }
    public function updateFromPage(Post $post){
        return view('editPostForm', ['post'=>$post]);
    }
    public function deletePost(Post $post){
       $post->delete();
       return redirect('/profile-posts/'.auth()->user()->username)->with('success','you deleted the post succesfully');
    }
    public function showProfilePosts(User $user){

        return view('profile-posts', ['username'=> $user->username , 'posts'=>$user->posts()->latest()->get() , 'postCounts' => $user->posts->count() , 'avatar' =>$user->avatar]);
    }

    public function maganeAvatarFromPage(User $user){

        if(auth()->user()->username !== $user->username  && !auth()->user()->isAdmin){
            return 'error 403 , not authorized';
        }
        return view('avatarFormPage' , ['username' => $user->username]) ;
    }
    public function storeAvatar(User $user , Request $request){
        if(auth()->user()->username !== $user->username &&  !auth()->user()->isAdmin ){
            return 'error 403 , not authorized';
        }

        $request->validate([
            'avatar'=> 'required|image|max:2000',
        ]);

     

        $imageData =  Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        $fileName = auth()->user()->id . '-' . uniqid().'.jpg' ; 

        Storage::put("public/avatars/".$fileName, $imageData);
        $oldAvatar = $user->avatar;
        $user->avatar = $fileName ;
        $user->save();

        if($oldAvatar !== '/storage/avatars/profile.jpg'){
            Storage::delete(str_replace('/storage','/public',$oldAvatar));
        }

        return back()->with('success', 'you uploaded your new avatar succesfully');
       

    }


}
