@extends('layouts.admin')

@section('content')

    @include('includes.flash-msg')

    <h1>Media</h1>

    @if(isset($photos))

        <form action="/delete/media" method="post" class="form-inline">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <div class="form-group">
                <select name="action-to-perform"  class="form-control">
                    <option value="">Select Option</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary">
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all" name="select-all" class="form-control"></th>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Created</th>
                </tr>
                </thead>

                <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{ $photo->id }}" ></td>
                        <td>{{ $photo->id }}</td>
                        <td><img height="100px" src="{{ $photo->file }}"></td>
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
                </tbody>

            </table>

        </form>

    @endif

@endsection

@section('scripts')
<script>
    jQuery(document).ready(function($){
        $('#select-all').on('click',function(){
            $('.checkBoxes').prop('checked', this.checked);
        });
    });
</script>
@endsection