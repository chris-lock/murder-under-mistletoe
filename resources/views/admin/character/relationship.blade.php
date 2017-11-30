<div class="well">
    @include('admin.component.form.delete', [
        'resource' => $relationship,
    ])

    <p>{{ $title }}</p>

    @component('admin.component.form.edit', [
        'resource' => $relationship,
    ])
        {{ Form::hidden('character_id', $character_id, array('class' => 'form-control')) }}
        {{ Form::hidden('relationship_id', $relationship_id, array('class' => 'form-control')) }}

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', $relationship->description, array(
                'class' => 'form-control',
                'rows' => '3',
            )) }}
        </div>
    @endcomponent
</div>
