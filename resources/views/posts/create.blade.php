@extends('layouts.app')
@section('content')

    <h1>Create post</h1>
    <hr/>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="fish" class="form-control mb-3" placeholder="Fish name"/>

        <textarea class="form-control mb-3" name="description" rows="4" placeholder="Description"></textarea>

        <input type="file" name="content_image" class="form-control mb-3" placeholder="Image"/>

        <button class="btn btn-primary float-end px-5" type="submit">Submit</button>
    </form>

@endsection
