@inject('relationship', 'App\Models\Relationship')
@extends('admin.component.edit')

@if(isset($resource->id))
    @section('tabs')
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="{{ isset($panel) ? "" : "active" }}">
                    <a href="#main" aria-controls="main" role="tab" data-toggle="tab">
                        Character
                    </a>
                </li>

                <li role="presentation" class="{{ (isset($panel) && $panel == "instructions") ? "active" : "" }}">
                    <a href="#instructions" aria-controls="instructions" role="tab" data-toggle="tab">
                        Instructions
                    </a>
                </li>

                <li role="presentation" class="{{ (isset($panel) && $panel == "relationships") ? "active" : "" }}">
                    <a href="#relationships" aria-controls="relationships" role="tab" data-toggle="tab">
                        Relationships
                    </a>
                </li>
            </ul>
        </div>
    @endsection
@endif

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
        {{ Form::textarea('bio', $resource->bio, array(
            'class' => 'form-control',
            'rows' => '3',
        )) }}
    </div>

    <div class="form-group">
        {{ Form::label('appearance', 'Appearance') }}
        {{ Form::textarea('appearance', $resource->appearance, array(
            'class' => 'form-control',
            'rows' => '3',
        )) }}
    </div>

    <div class="form-group">
        {{ Form::label('story', 'Story') }}
        {{ Form::textarea('story', $resource->story, array(
            'class' => 'form-control',
            'rows' => '3',
        )) }}
    </div>

    <div class="form-group">
        {{ Form::label('murder', 'Murder') }}
        {{ Form::textarea('murder', $resource->murder, array(
            'class' => 'form-control',
            'rows' => '3',
        )) }}
    </div>
@endsection

@if(isset($resource->id))
    @push('tab-panes')
        <div role="tabpanel" class="tab-pane{{ (isset($panel) && $panel == "instructions") ? " active" : "" }}" id="instructions">
            <div class="panel-default">
                @foreach ($acts as $act)
                    @include('admin.character.act', [
                        'act' => $act,
                        'character_id' => $resource->id,
                    ])
                @endforeach
            </div>
        </div>
    @endpush

    @push('tab-panes')
        <div role="tabpanel" class="tab-pane{{ (isset($panel) && $panel == "relationships") ? " active" : "" }}" id="relationships">
            <div class="panel-default">
                @foreach ($characters as $character)
                    <div class="panel-heading">
                        {{ $character->full_name }}
                    </div>

                    <div class="panel-body">
                        @include('admin.character.relationship', [
                            'relationship' => $relationships->get()->first(function ($relationship) use($character) {
                                return $relationship->relationship_id == $character->id;
                            }) ?? new $relationship,
                            'title' => 'Relationship to',
                            'character_id' => $resource->id,
                            'relationship_id' => $character->id,
                        ])

                        @include('admin.character.relationship', [
                            'relationship' => $perceptions->get()->first(function ($perception) use($character) {
                                return $perception->character_id == $character->id;
                            }) ?? new $relationship,
                            'title' => 'Perception from',
                            'character_id' => $character->id,
                            'relationship_id' => $resource->id,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    @endpush
@endif
