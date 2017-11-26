@extends('admin.admin')

@section('panel')
  <div class="panel-heading clearfix">
    <h1 class="panel-title pull-left">{{ $action }} Act</h1>

    @if($action == 'Update')
        {{ Form::open(array('url' => $url, 'method' => 'DELETE')) }}
            {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs pull-right')) }}
          {{ Form::close() }}
      @endif
  </div>

  <div class="panel-body">
    {{ Html::ul($errors->all()) }}

    {{ Form::open(array('url' => $url, 'method' => $method)) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $act->title, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('begins', 'Begins') }}
            {{ Form::time('begins', $act->begins, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit($action, array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
@endsection
