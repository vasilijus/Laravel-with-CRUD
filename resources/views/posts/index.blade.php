@extends('layouts.app')

@section('content')

        @if (count($posts) > 0)
        <ul class="list-group">
            @foreach ($posts as $post)
            	<div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/{{ $post->cover_image }}">
                            <!-- <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}"> -->
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written by {{$post->user->name}} on {{$post->title}}</small>
                        </div>
                    </div>
                    
                    <!-- {{ $post }} -->
                </div>
            @endforeach
        @else
        	<p>no posts</p>
        @endif
ln -
@endsection