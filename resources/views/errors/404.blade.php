@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class='error'>
        <h1>404</h1>
        <p>The thing you were looking for isn't where you'd hoped it would be (sorry).</p>
        <p><a href='javascript: window.history.go(-1)' class='button'>Go Back</a></p>
    </div>
@endsection
