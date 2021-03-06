@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/fiches/questions/'.$question->id) }}" >
                        {{ csrf_field() }}
                        {{method_field('put')}}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre (*)</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{checkOldValue(old('title'), $question->title) }}" autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="class_level" class="col-md-4 control-label">Niveau </label>
                            <div class="col-md-6">
                            <select name="class_level" id="class_level" class="form-control">
                                <option value="premiere" {{checkSelect('premiere', checkOldValue(old('class_level'), $question->class_level)) }}>Première S </option>
                                <option value="terminale" {{checkSelect('terminale', checkOldValue(old('class_level'), $question->class_level)) }}> Terminal S </option>
                            </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="content" class="col-md-4 control-label">Redaction de la question(*)</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content"> {{checkOldValue(old('content'), $question->content)}}  </textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit">envoyer </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

