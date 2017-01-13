@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.nav_admin_eleve')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Eleve</div>

                <div class="panel-body">
                    Eleve : {{$user->id}}
                    Score : {{$scoreEleve}}
                    Qcm effectués : {{$qcmFait}} / {{$total}}
                </div>
                <div> <a href="{{url('student/qcm')}}">Liste des qcm</a> </div>
            </div>
        </div>
    </div>
</div>
@endsection