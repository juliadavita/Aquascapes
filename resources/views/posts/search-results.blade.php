@extends('layouts.app')
@section('content')


    @include('components.search')


    <h1>Search results</h1>
    <p>5 results for '{{ request()->input('query') }}'</p>


@endsection
