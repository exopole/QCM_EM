<?php use Illuminate\Support\Str;?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
@include('layouts.nav_admin_prof')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-body">
                    teacher identifiant : {{$user->id}}


<h2> CRUDS des fiches </h2>
@if(count($fiches)>0)
    <?php $i=0 ?>
    @while ($i < count($fiches) && $i < 3)
        <div>
            <p style = "display:inline-block;">
                <a href="{{url('teacher','fiches')}}">{{$fiches[$i]->title}}</a>;
                 {{$fiches[$i]->class_level}} ;
                 @if($fiches[$i]->status == 'published')
                    <div style = "background:lightgreen ; width:20px; height:20px; display:inline-block;"></div>
                @else
                    <div style = "background:red ; width:20px; height:20px; display:inline-block;"></div>
                @endif
            </p>
             

        </div>
        <?php $i++ ?>
    @endwhile
    
@else
    <p>désolé aucune fiches</p>
@endif


<h2>CRUDS des articles de {{$user->username}}</h2>
@if(count($posts)>0)
    <?php $i=0 ?>
    @while ($i < count($posts) && $i < 3)
        <div>
            <p style = "display:inline-block;"> <a href="{{url('teacher','posts')}}">{{$posts[$i]->title}}</a>
 ;
        @if($posts[$i]->status == 'published')
                    <div style = "background:lightgreen ; width:20px; height:20px; display:inline-block;"></div>
                @else
                    <div style = "background:red ; width:20px; height:20px; display:inline-block;"></div>
                @endif
        {{$posts[$i]->date}} 
</p>
             

        </div>
        <?php $i++ ?>
    @endwhile    
@else
    <p>désolé aucun article</p>
@endif


<h2>Fiches des élèves</h2>
@if(count($students)>0)
    @foreach($students as $student)
        {{$student->username}};
    @endforeach
@else
    <p>ce professeur n'a aucun élèves</p>
@endif

<p>{{$nbrComments}} commentaires </p>
<p>{{count($fiches)}} fiches publiées </p>
<p>Nombre d'élèves : {{count($students)}} </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection