@extends('layouts.admin')


@section('content')


    <h1>Replies</h1>

    <table class="table">

        @if(count($replies) > 0 )
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
            </thead>

            <tbody>
            @foreach($replies as $replie )
                <tr>
                    <td>{{ $replie->id  }}</td>
                    <td>{{ $replie->author }}</td>
                    <td>{{ $replie->email  }}</td>
                    <td>{{ $replie->body  }}</td>
                    <td><a href="{{ route('home.post' , $replie->comment->post_id) }}">View Post</a></td>
                    <td>
                        @php
                            $status = $replie->is_active ? "Unapprove" : "Approve"
                        @endphp

                        {!! Form::open(['method' => 'patch', 'action' => ['CommentRepliesController@update',$replie->id] ]) !!}
                        <input type="hidden" name="is_active" value="{{ $replie->is_active ? 0 : 1  }}">

                        {!! Form::submit($status,['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'delete', 'action' => ['CommentRepliesController@destroy',$replie->id] ]) !!}

                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>

        @else
            <h3>No Replies</h3>
        @endif
    </table>

@endsection