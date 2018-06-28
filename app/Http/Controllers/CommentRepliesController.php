<?php

namespace App\Http\Controllers;

use App\CommentReply;
use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $comment = comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show',compact('replies'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //return $request->only('is_active');
        if(isset($request->is_active)) {
            $commentReply = CommentReply::findOrFail($id);
            $commentReply->update($request->all());

        }
        return redirect()->back();
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
        $commentReply = CommentReply:: findOrFail($id);
        $commentReply->delete();
        return redirect()->back();
    }

    public function createReply(Request $request){

        if(Auth::check()){

            $user = Auth::user();

            $data = [
                'comment_id'  => $request->comment_id,
                'body'   => $request->body,
                'author' => $user->name,
                'email'  => $user->email,
                'user_id'=> $user->id
            ];

            CommentReply::create($data);
            $request->session()->flash('comment_msg',"Your comment has been submitted and waiting for approval");
            //  return $data;
            return redirect()->back();
        }
    }
}