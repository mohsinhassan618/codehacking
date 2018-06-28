@extends('layouts.admin')


@section('content')

    @include('includes.flash-msg')


    <h1>Posts index</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>


        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id  }}</td>
                    <td> <img height="50px" src="{{ !empty($post->photo->file) ? $post->photo->file : "http://placehold.it/400x400"  }}" > </td>
                    <td><a href="{{ route('posts.edit',$post->id) }}" >{{ $post->user->name }}</a></td>
                    <td>{{ !empty($post->category_id) ? $post->category_id : "Uncategorized"  }}</td>
                    <td>{{ $post->title  }}</td>
                    <td>{{ str_limit($post->body,30 )  }}</td>
                    <td>{{ $post->created_at->diffForhumans()  }}</td>
                    <td>{{ $post->updated_at->diffForhumans()  }}</td>
                    <td><a href="{{ route('home.post' , $post->slug) }}">View Post</a></td>
                    <td><a href="{{ route('comments.show' , $post->id ) }}">View Comments</a></td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-offset-5 col-xs-6">
            {{ $posts->links() }}
        </div>

    </div>

@endsection