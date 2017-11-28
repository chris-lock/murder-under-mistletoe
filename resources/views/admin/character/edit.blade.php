@extends('admin.component.edit')

@section('form')
    <div class="form-group">
        {{ Form::label('guest', 'Guest') }}
        {{ Form::text('guest', $resource->guest, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('first_name', 'First Name') }}
        {{ Form::text('first_name', $resource->first_name, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('last_name', 'Last Name') }}
        {{ Form::text('last_name', $resource->last_name, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('bio', 'Bio') }}
        {{ Form::textarea('bio', $resource->bio, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('appearance', 'Appearance') }}
        {{ Form::textarea('appearance', $resource->appearance, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('story', 'Story') }}
        {{ Form::textarea('story', $resource->story, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('murder', 'Murder') }}
        {{ Form::textarea('murder', $resource->murder, array('class' => 'form-control')) }}
    </div>
@endsection
