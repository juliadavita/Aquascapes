
@extends('contacts.layout')
@section('content')
    <div class="card">
        <div class="card-header">Create a new post</div>
        <div class="card-body">

            <form action="{{ url('post') }}" method="post">
                {!! csrf_field() !!}
                @method("PATCH")
                <input type="hidden" name="id" id="id" value="{{$posts->id}}" id="id" />
                <label>Fish</label></br>
                <input type="text" name="fish" id="fish" value="{{$posts->fish}}" class="form-control"></br>
                <label>About</label></br>
                <input type="text" name="about" id="about" value="{{$posts->about}}"class="form-control"></br>
                <input type="submit" value="Save" class="btn btn-success"></br>
            </form>

        </div>
    </div>
@stop
