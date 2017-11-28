@extends('admin.component.edit')

@section('form')
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $resource->title, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('begins', 'Begins') }}
        {{ Form::date('begins', $resource->begins, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('copy', 'Copy') }}
        {{ Form::textarea('copy', $resource->copy, array('class' => 'form-control')) }}
    </div>
@endsection

