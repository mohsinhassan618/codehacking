@if(Session::has('msg'))
    <div class="row alert-danger">
        <p> {{ session('msg') }} </p>
    </div>
@endif