@extends('layouts.admin')


@section('content')


    <h1>Comments</h1>

    <table class="table">

        @if(count($comments) > 0 )
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
            </thead>

            <tbody>
            @foreach($comments as $comment )
                <tr>
                    <td>{{ $comment->id  }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->email  }}</td>
                    <td>{{ $comment->body  }}</td>
                    <td><a href="{{ route('home.post' , $comment->post_id) }}">View Post</a></td>
                    <td><a href="{{ route('admin.comment.replies.show' , $comment->id) }}">View Replies</a></td>
                    <td>
                        @php
                            $status = $comment->is_active ? "Unapprove" : "Approve"
                        @endphp

                        {!! Form::open(['method' => 'patch', 'action' => ['PostCommentsController@update',$comment->id] ]) !!}
                        <input type="hidden" name="is_active" value="{{ $comment->is_active ? 0 : 1  }}">

                        {!! Form::submit($status,['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'delete', 'action' => ['PostCommentsController@destroy',$comment->id] ]) !!}

                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>

        @else
            <h3>No comments</h3>
        @endif
    </table>

@endsection