@extends('layouts.admin')



@section('content')

    <div class="row">

            <h1>Edit Category</h1>

            {!! Form::model($category,['method' => 'patch', 'action' => ['AdminCategoriesController@update',$category->id], 'files'=> true ]) !!}

            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Category',['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy',$category->id] ]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category',['class' => 'btn btn-danger col-sm-6' , 'onclick' => 'confirm("Do you really want to delete")']) !!}
            </div>
            {!! Form::close() !!}

    </div>



    @include('includes.form-errors')

@endsection


