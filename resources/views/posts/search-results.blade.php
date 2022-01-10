@extends('layouts.app')
@section('content')


    @include('components.search')


<h1>Search</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr></tr>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($posts as $post) {{-- Loop posts --}}
        <tr>
            <td>{{ $post->fish }}</td>
            <td>{{ $post->description }}</td>
            <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>



@endsection
