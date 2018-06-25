@extends('layouts.admin')


@section('content')

    @include('includes.flash-msg')


    <h1>Media</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Created</th>
        </tr>
        </thead>


        <tbody>
        @if(isset($photos))
            @foreach($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td><img height="100px" src="{{ $photo->file }}" > </td>
                    <td>{{ $photo->created_at instanceof  Carbon\Carbon ? $photo->created_at->diffForHumans() : $photo->created_at }}</td>
                    <td>

                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id ] ]) !!}
                         <div class="form-group">
                            {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                         </div>

                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

@endsection