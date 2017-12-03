<div class="well">
    @include('admin.component.form.delete', [
        'resource' => $instruction,
    ])

    @component('admin.component.form.edit', [
        'resource' => $instruction,
    ])
        {{ Form::hidden('act_id', $act_id, array('class' => 'form-control')) }}
        {{ Form::hidden('character_id', $character_id, array('class' => 'form-control')) }}

        <div class="form-group">
            {{ Form::label('copy', 'Copy') }}
            {{ Form::text('copy', $instruction->copy, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('value', 'Value') }}
            {{ Form::number('value', $instruction->value, array('class' => 'form-control')) }}
        </div>
    @endcomponent
</div>
