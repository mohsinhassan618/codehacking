<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();
        $categories = ['' => 'Chose Categories'] + $categories   ;
        // print_r($categories);
        // return;
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        if(Auth::check()){
            $user = Auth::user();
        }
        else {
            exit;
        }

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        $categories = ['' => 'Chose Categories'] + $categories  ;
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        //

        $user = Auth::User();
        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')) {

            //Delete previous photo
            if(isset($post->photo->file) && file_exists( public_path() . $post->photo->file )){
                unlink(public_path() . $post->photo->file);
            }

            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->whereId($id)->first()->update($input);
        return  redirect('/admin/posts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::FindOrFail($id);
        if(isset($post->photo->file) &&  file_exists( public_path() . $post->photo->file )){
            unlink(public_path() . $post->photo->file);
        }

        $post->delete();
        Session::flash('msg',"Delete Successfully");
        return redirect('admin/posts');
    }

    public function post($id){

       $post = Post::findOrFail($id);
       $comments = $post->comments()->whereIsActive(1)->get();
       return view('post',compact('post','comments'));
    }
}
