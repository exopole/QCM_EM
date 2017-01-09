<?php use Illuminate\Support\Str;?>
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
@if(count($posts)>0)
    <?php $i = 0; ?>

    <div>
        <img src="{{url('images', $posts[$i]->url_thumbnail)}}" ; >
        <h2>{{$posts[$i]->title}}</h2>

        <div>{{Str::limit($posts[$i]->abstract, 50, '...')}}</div>
          <a href="{{url('post',$posts[$i]->id)}}">Lire la suite </a>
            <p> {{count($posts[$i]->comments)}} commentaires</p>
            <p>Author : {{$authors[$posts[$i]->user_id]->username}} </p>

        </div>
    </div>
    <?php $i++ ?>

    @while($i < count($posts) && $i < 3)
        <img src="{{url('images', $posts[$i]->url_thumbnail)}}" ; >
        <h2>{{$posts[$i]->title}}</h2>
        <div>{{Str::limit($posts[$i]->abstract, 50, '...')}}</div>
        <a href="{{url('post',$posts[$i]->id)}}">Lire la suite </a>
<?php $i++; ?>        
    @endwhile
@else
    <p>désolé aucun article</p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
