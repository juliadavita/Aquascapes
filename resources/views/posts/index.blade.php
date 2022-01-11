@extends('layouts.app')
@section('content')



    @include('components.search')
    @include('components.filter-dropdown')



    <table class="table table-striped table-hover">
        <thead>
        <tr></tr>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Blogger</th>
            <th scope="col">Soort</th>
            <th scope="col">Image</th>
            @if(auth()->check() && auth()->user()->is_admin == 1)<th scope="col">Action </th>@endif


        </tr>
        </thead>
        <tbody>

        @foreach ($posts as $post) {{-- Loop posts --}}
        <tr>

            <td>{{ $post->fish }}</td>
            <td>{{ $post->description }}</td>
            <td>{{ $post->user_id }}</td>
            <td>{{ $post->category }}</td>
            <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>
            <td>

                @if(auth()->check() && auth()->user()->is_admin == 1)
                <div class="dropdown">
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="actionDropdown"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                        <li><a class="dropdown-item" href="{{ route('posts.show', $post->id) }}">View</a></li> {{-- View --}}
                        <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a></li> {{-- Edit --}}
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post"> {{-- Delete --}}
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
                    @endif
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>


@endsection
