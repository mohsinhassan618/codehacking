@extends('layouts.admin')


@section('content')


      <table class="table">
        <thead>
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Role</th>
              <th>Active</th>
              <th>Email</th>
              <th>Created</th>
              <th>Updated</th>
          </tr>
        </thead>


        <tbody>
        @if($users)
          @foreach($users as $user)
            <tr>
                <td> {{$user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ !empty($user->role) ? $user->role->name : "No Role" }}</td>
                <td>{{ $user->is_active == 1 ? "Active" : "Not Active" }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
          @endforeach
        @endif

        </tbody>
      </table>

@endsection