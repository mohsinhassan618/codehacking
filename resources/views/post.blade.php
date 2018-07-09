@extends('layouts.blog-post')


@section('content')


    <!-- Title -->
    <h1>{{ !empty($post->title) ? $post->title : '' }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>
        Posted {{ $post->created_at instanceof \Carbon\Carbon ? $post->created_at->diffForHumans() : $post->created_at  }}
    </p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ isset($post->photo->file) ? $post->photo->file : "www.placeholder.com/700x700" }}" alt="">

    <hr>

    <!-- Post Content -->
    <p> {!!   $post->body !!}</p>
    <hr>
    @if(Session::has('comment_msg'))
        {{ Session('comment_msg') }}
    @endif
    <!-- Blog Comments -->

    @if(Auth::check())
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method' => 'post', 'action' => 'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                {!! Form::label('body','Body:') !!}
                {!! Form::textarea('body',null,['class' => 'form-control','rows' => 3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if( count($comments) > 0)

        @foreach($comments as $comment)

            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64px" class="media-object" src="{{ isset($comment->user->gravatar) ? $comment->user->gravatar : 'http://placehold.it/64x64'  }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"> {{ $comment->author }}
                        <small>{{ $comment->created_at instanceof \Carbon\Carbon ? $comment->created_at->diffForHumans(): $comment->created_at}}</small>
                    </h4>
                   {{   isset($comment->body) ? $comment->body : null }}


                    <div class="nested-comment comment-reply-container">


                    @if(count( $comment->replies ) > 0 )
                        @foreach( $comment->replies as $reply)

                            <!-- Nested Comment -->
                                <div class=" media">
                                    <a class="pull-left" href="#">
                                        <img height="64px" class="media-object"
                                             src="{{ isset($comment->user->gravatar) ? $comment->user->gravatar : 'http://placehold.it/64x64'  }}"
                                             alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"> {{ $reply->author }}
                                            <small>{{ $reply->created_at instanceof \Carbon\Carbon ? $reply->created_at->diffForHumans(): $reply->created_at}}</small>
                                        </h4>
                                        {{ isset($reply->body) ? $reply->body : null }}
                                    </div>
                                </div>
                                <!-- End Nested Comment -->
                            @endforeach
                        @endif

                        <button id="reply-button"  class="btn btn-primary pull-right">Reply</button>
                        <div class="reply-form">

                            {!! Form::open(['method' => 'post', 'action' => 'CommentRepliesController@createReply']) !!}

                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <div class="form-group">
                                {!! Form::label('body','Reply:') !!}
                                {!! Form::textarea('body',null,['class' => 'form-control','rows' => 2]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>

        @endforeach

    @endif


@endsection

@section('scripts')
<script>
    $('button#reply-button').on('click',function () {
        $(this).css("display","none");
        $(this).next().css('display','block');
    });

</script>


@endsection