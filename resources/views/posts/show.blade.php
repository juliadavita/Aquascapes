@extends('layouts.app')

@section('content')
    <h1>Post Show</h1>
    <hr/>

    <div class="bg-dark text-white rounded p-3">
        <h5 class="text-warning">Fish</h5>
        <p class="fw-bold">{{ $post->fish }}</p>

        <h5 class="text-warning">Description</h5>
        <p class="fw-bold">{{ $post->description }}</p>
    </div>

@endsection
