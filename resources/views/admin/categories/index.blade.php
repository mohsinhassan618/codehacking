@extends('layouts.admin')


@section('content')

    @include('includes.flash-msg')


    <h1>Categories</h1>

    <div class="col-sm-6">


        {!! Form::open(['method' => 'post', 'action' => 'AdminCategoriesController@store']) !!}
         <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class' => 'form-control']) !!}
         </div>

         <div class="form-group">
            {!! Form::submit('Create Category',['class' => 'btn btn-primary']) !!}
         </div>
        {!! Form::close() !!}

        @include('includes.form-errors')
    </div>

    <div class="col-sm-6">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($categories))
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id  }}</td>
                        <td><a href="{{ route('categories.edit',$category->id) }}"> {{ $category->name  }} </a> </td>
                        <td>{{ $category->created_at instanceof Carbon\Carbon ? $category->created_at->diffForhumans() : $category->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <h1> No Posts Found</h1>
            @endif

            </tbody>
        </table>

    </div>

@endsection