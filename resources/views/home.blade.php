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

                    {{ __('Welcome hello')  }}
                        <br>

                        @foreach ($posts as $post) {{-- Loop posts --}}
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->fish }}</td>
                            <td>{{ $post->description }}</td>
                            <td><img src="/content_image/{{ $post->content_image }}" width="150px"></td>
                            <td>
                                <form action="/home/visibility/{{$post->id}}" enctype="multipart/form-data" method="post" >
                                    @method('PATCH')
                                    <button>Show/Hide</button>
                                    @csrf
                                </form>
                            </td>
                            <td>
                        </tr>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
