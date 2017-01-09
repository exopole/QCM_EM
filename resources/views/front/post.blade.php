@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <div class="title m-b-md">
                    Page d'une actualité
                </div>
                    <div> Title : {{$post->title}} </div>
                    <div> abstract : {{$post->abstract}} </div>
                    <div> content : {{$post->content}}</div>
                    <div> date : {{$post->date}} </div>
                    <div> author : {{$author->username}} </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
