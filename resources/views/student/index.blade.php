@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Eleve</div>

                <div class="panel-body">
                    Eleve : {{$user->id}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection