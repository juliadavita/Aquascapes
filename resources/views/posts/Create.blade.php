
@extends('posts.layout')
@section('content')
    <div class="card">
        <div class="card-header">Create a new post</div>
        <div class="card-body">

            <form action="{{ url('post') }}" method="post">
                {!! csrf_field() !!}
                <label>Fish</label></br>
                <input type="text" name="fish" id="name" class="form-control"></br>
                <label>About</label></br>
                <input type="text" name="about" id="address" class="form-control"></br>
                <input type="submit" value="Save" class="btn btn-success"></br>
            </form>

        </div>
    </div>
@stop
