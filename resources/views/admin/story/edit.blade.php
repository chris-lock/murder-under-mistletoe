@extends('admin.admin')

@section('panel')
  <div class="panel-heading">
    <h1 class="panel-title">Story</h1>
  </div>

  <div class="panel-body">
    {{ Html::ul($errors->all()) }}

    {{ Form::open(array('url' => $url, 'method' => $method)) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $story->title, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('begins', 'Begins') }}
            {{ Form::date('begins', $story->begins, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('copy', 'Copy') }}
            {{ Form::textarea('copy', $story->copy, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit($button, array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
@endsection
