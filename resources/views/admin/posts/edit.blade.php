@extends('layouts.admin')



@section('content')

    <div class="row">

        <div class="col-sm-3">

            <img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}"
                 class="img img-responsive img-rounded">
        </div>

        <div class="col-sm-9">

            <h1>Edit Post</h1>


            {!! Form::model($post,['method' => 'patch', 'action' => ['AdminPostsController@update',$post->id], 'files'=> true ]) !!}

            <div class="form-group">
                {!! Form::label('title','Title:') !!}
                {!! Form::text('title',Null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category:') !!}
                {!! Form::select('category_id',  $categories,Null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id','Photo:') !!}
                {!! Form::file('photo_id',Null) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body','Description') !!}
                {!! Form::textarea('body',Null,['class' => 'form-control'] ) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Update Post',['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy',$post->id] ]) !!}
            <div class="form-group">
                {!! Form::submit('Delete User',['class' => 'btn btn-danger col-sm-6']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>


    @include('includes.form-errors')

@endsection


