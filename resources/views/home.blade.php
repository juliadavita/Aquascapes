@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard of') }} {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Have a look at your posts!')  }}
                        <br>

                        <table class="table table-striped table-hover">
                            <thead>
                            <tr></tr>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Fishonatic</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($posts as $post) {{-- Loop posts --}}
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $post->fish }}</td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->user_id }}</td>
                                <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>
                                <td>


                                        <div class="dropdown"> {{-- Dropdown --}}
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
                                                    <li>
                                                        <form action="/home/visibility/{{$post->id}}" enctype="multipart/form-data" method="post" >--}}
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">Show/Hide</button>
                                                            @csrf
                                                        </form>
                                                    </li>
                                            </ul>
                                        </div>

                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>

{{--                        @foreach ($posts as $post) --}}{{-- Loop posts --}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{ $loop->iteration }}</th>--}}
{{--                            <td>{{ $post->fish }}</td>--}}
{{--                            <td>{{ $post->description }}</td>--}}
{{--                            <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>--}}
{{--                            <td>--}}
{{--                                <div class="dropdown"> --}}{{-- Dropdown --}}
{{--                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="actionDropdown"--}}
{{--                                            data-mdb-toggle="dropdown" aria-expanded="false">--}}
{{--                                        Action--}}
{{--                                    </button>--}}
{{--                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">--}}
{{--                                        <li><a class="dropdown-item" href="{{ route('posts.show', $post->id) }}">View</a></li> --}}{{-- View --}}
{{--                                        <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a></li> --}}{{-- Edit --}}
{{--                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post"> --}}{{-- Delete --}}
{{--                                            <li>--}}
{{--                                                <hr class="dropdown-divider">--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <form action="{{ route('posts.destroy', $post->id) }}" method="post"> --}}{{-- Delete --}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                    <button type="submit" class="dropdown-item">Delete</button>--}}
{{--                                                </form>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <form action="/home/visibility/{{$post->id}}" enctype="multipart/form-data" method="post" >--}}
{{--                                                    @method('PATCH')--}}
{{--                                                    <button type="submit" class="dropdown-item">Show/Hide</button> --}}{{-- Show/Hide --}}
{{--                                                    @csrf--}}
{{--                                                </form>--}}
{{--                                            </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
