@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                 <form class="form-horizontal" role="form" method="POST" action="{{ url('student/qcm/'.$question->id) }}">
                        {{ csrf_field() }}
                        {{method_field('put')}}

                    <div>{{$question->title}}</div>
                    @if(count($choices) > 0)
                        @foreach($choices as $choice)
                            <div>
                                <div>{{$choice->content}}</div>
                                Oui <input type="checkbox" name="{{$choice->id}}" value='yes'> 
                                Non <input type="checkbox" name="{{$choice->id}}" value="no">

                            </div>
                        @endforeach
                    @else
                        pas de choices

                    @endif

                     <button type="submit">envoyer </button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection