@extends('layouts.app')
@section('content')


    @include('components.search')


    <h1>Search results</h1>

    <p>5 results for '{{ request()->input('query') }}'</p>




    @if(isset($posts))
        <p>Resultaat gevonden</p>
        @foreach ($posts as $post)
            <tr>

                <td>{{ $post->fish }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->user_id }}</td>



                <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>
                <td>

                    @if(auth()->check() && auth()->user()->is_admin == 1)
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
                            </ul>
                        </div>
                    @endif
                </td>
            </tr>

        @endforeach
    @endif

    @if(isset($error))
        <p>{{ $error }}</p>
    @endif

@endsection
