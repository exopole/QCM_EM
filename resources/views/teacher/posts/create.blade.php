@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/posts') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
 

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="col-md-4 control-label">Enseignant </label>
                            <div class="col-md-6">
                            <select name="user_id" id="user_id" class="form-control">

                            @if(count($teachers)>0)

                                @foreach($teachers as $teacher)
                                    <option value={{$teacher->id}} {{checkSelect($teacher->id, $auth->id)}}>{{$teacher->username}} </option>
                                @endforeach
                            @endif
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="abstract" class="col-md-4 control-label">Abstract</label>

                            <div class="col-md-6">
                                <textarea id="abstract" class="form-control" name="abstract"> {{old('abstract')}}  </textarea>

                                @if ($errors->has('abstract'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abstract') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-4 control-label">Contenu</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content"> {{old('content')}}  </textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="url_thumbnail" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="url_thumbnail" type="file" class="form-control" name="url_thumbnail" >

                                @if ($errors->has('url_thumbnail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url_thumbnail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                            <select name="status" id="status" class="form-control">
                                <option value="published">Publié</option>
                                <option value="unpublished">dépublié</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div>
                                <label for="date" class="col-md-4 control-label">Date de publication</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="date" name="date" id="date" value="{{old('date')}}">
                            @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                                </div>
                                </div>
                        </div>
                        <button type="submit">Appliquer </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

