@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @for($i = 0; $i<count($scores); $i++)
                        <?php $score =  App\Score::find($scores[$i]->id)?>
                        <div>
                        {{$score->status }};

                        @if($score->status == 'fait') 
                            {{$score->question->title}}
                        @else
                            <a href="{{url('student/qcm/'.$score->question_id)}}">{{$score->question->title}}</a>
                        @endif
                        </div>

                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection