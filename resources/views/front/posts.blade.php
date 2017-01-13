<?php use Illuminate\Support\Str;?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
@if(count($posts)>0)

    @foreach($posts as $post)
                    <div>
        @if($post->url_thumbnail)

                        <img src="{{url('images', $post->url_thumbnail)}}" ; >
        @endif
                        <h2>{{$post->title}}</h2>

                        <div>{{Str::limit($post->abstract, 50, '...')}}</div>
                        <a href="{{url('post',$post['id'])}}">{{$post->title}}</a>
                        <p> {{count($post->comments)}} commentaires</p>
            @if($post->user_id)
                        <p>Author : {{$authors[$post->user_id]->username}} </p>
            @endif

                    </div>
    @endforeach
@else
    <p>désolé aucun article</p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
