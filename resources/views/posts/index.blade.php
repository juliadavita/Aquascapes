@extends('layouts.app')
@section('content')



    @include('components.search')
    <br>
    @include('components.filter-dropdown')


    <table class="table table-striped table-hover">
        <thead>
        <tr></tr>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Fishonatic</th>
            <th scope="col">Kind</th>
            <th scope="col">Image</th>
            @if(auth()->check() && auth()->user()->is_admin == 1)<th scope="col">Action </th>@endif


        </tr>
        </thead>
        <tbody>

        @foreach ($posts as $post) {{-- Loop posts --}}
        <tr>

            <td>{{ $post->fish }}</td>
            <td>{{ $post->description }}</td>
            <td>{{ $post->username }}</td>
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
{{--                        <li><a class="dropdown-item" href="{{ route('posts.show', $post->id) }}">View</a></li> --}}{{-- View --}}
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
                            <form action="/home/visibility/{{$post->id}}" enctype="multipart/form-data" method="post" >
                                @method('PATCH')
                                <button type="submit" class="dropdown-item">Show/Hide</button>
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                    @endif
                <br>
                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View</a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>


@endsection
