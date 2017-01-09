@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/fiches/choices/'.$questionID) }}">
                        {{ csrf_field() }}
                        {{method_field('put')}}
                         @for ($i = 0; $i < $nbrChoice; $i++)
                            <h4>Question {{$i+1}} </h4>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <textarea id="{{ $choices[$i]->id}}_content" class="form-control" name="{{ $choices[$i]->id}}_content"> {{checkOldValue(old('content'), $choices[$i]->content)}}  </textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <input type="checkbox" name="{{ $choices[$i]->id}}_status" value="yes" {{checked('yes', checkOldValue(old($choices[$i]->id.'_status'), $choices[$i]->status))}} > oui
                                    <input type="checkbox" name="{{ $choices[$i]->id}}_status" value="no" {{checked('no', checkOldValue(old($choices[$i]->id.'_status'), $choices[$i]->status))}}> non
                                </div>
                            </div>
                        @endfor

                        <button type="submit">envoyer </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

