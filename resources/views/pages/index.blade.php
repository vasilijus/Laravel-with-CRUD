@extends('layouts.app')

@section('content')

        
        @if (Auth::guest() )
                <div class="jumbotron text-center">
                <h2>Welcome to Blogger.</h2>
                <p>Please be aware of the content that you are posting.</p>
                <p><b>Login or Register</b> to be able to share your posts here.</p>
                        <p><a class="btn btn-primary" href="{{ route('login') }}">Login</a></p>
                        <p><a class="btn btn-primary" href="{{ route('register') }}">Register</a></p>
                </div>
        @else
                <div class="jumbotron text-center">
                        <h3>Hello {{ Auth::user()->name }}</h3>
                        <br>
                        <p>
                                <a class="btn btn-primary" href="/posts/create">Create Post</a>
                                <a class="btn btn-primary" href="/posts">Your Timeline</a>
                        </p>
                </div>
        @endif
        
@endsection
