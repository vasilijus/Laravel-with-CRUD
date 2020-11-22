@extends('layouts.app')

@section('content')

<style>
.list-group {
    
}
.list-group .well .row {
        
}

</style>
<h2>Blog History </h2>
        @if (count($posts) > 0)
        <ul class="list-group" style="display: grid;
                                grid-template-columns: repeat(3, 1fr);
                                grid-template-rows: 1fr 1fr 1fr;
                                gap: 10px 10px;">
            @foreach ($posts as $post)
            	<div class="well">
                    <div class="row" style="display: grid;
                                        grid-template-rows: 0px 150px;">
                        <!-- <div class="col-md-4 col-sm-4"> -->
                        <div class="col-md-12 col-sm-12">
                            <img style="width:100%" src="/{{ $post->cover_image }}">
                            <!-- <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}"> -->
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written by {{$post->user->name}} on <br>
                                <i>{{$post->created_at}}</i></small>
                        </div>
                    </div>
                    
                    {{ $post }}
                </div>
            @endforeach
        @else
        	<p>no posts</p>
        @endif

@endsection