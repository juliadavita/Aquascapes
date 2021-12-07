@extends('layouts.app')
@section('content')

    <h1>Aquascapes</h1>
    <a class="btn btn-link float-end" href="{{ route('posts.create') }}">Create Post</a>

    {{-- Display message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
        <tr></tr>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($posts as $post) {{-- Loop posts --}}
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $post->fish }}</td>
            <td>{{ $post->description }}</td>
            <td><img src="/content_image/{{ $post->content_image }}" width="100px"></td>
{{--            <td>{{ $post->content_image }}</td>--}}
            <td>

                <div class="dropdown"> {{-- Dropdown --}}
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="actionDropdown"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                        <li><a class="dropdown-item" href="{{ route('posts.show', $post->id) }}">View</a></li> {{-- View --}}
                        <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a></li> {{-- Edit --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post"> {{-- Delete --}}
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>


@endsection
