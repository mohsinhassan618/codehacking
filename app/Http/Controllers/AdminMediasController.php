<?php

namespace App\Http\Controllers;

use App\Photo;
use function dd;
use Illuminate\Http\Request;

use App\Http\Requests;
use function print_r;
use function redirect;
use function session;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
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

        if(!empty($request->file('file'))){

            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            Photo::create(['file' => $name]);
            return 1;
        } else {
            return 0;
        }


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
        $photo = Photo::findOrFail($id);

        if( isset($photo->file) && file_exists(public_path(). $photo->file)){
            unlink(public_path(). $photo->file);
        }
        $photo->delete();
        return redirect('/admin/media');
    }

    public function upload(){

        return view('admin.media.create');
    }


    public function deleteMedia(Request $request){

        if( empty($request->input('action-to-perform') ) || empty($request->input('checkBoxArray')) ){
            session()->flash('msg','NO Action Performed');
            return redirect()->back();
        }

        $data = $request->input('checkBoxArray');


        foreach ($data as $id){
            $photo = Photo::findOrFail($id);
            if( isset($photo->file) && file_exists(public_path(). $photo->file)){
                unlink(public_path(). $photo->file);
            }
            $photo->delete();
        }

        session()->flash('msg','Records Deleted Successfully');

        return redirect()->back();

    }
}
