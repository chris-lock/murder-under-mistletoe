<div class="well">
    @include('admin.component.form.delete', [
        'resource' => $instruction,
    ])

    @component('admin.component.form.edit', [
        'resource' => $instruction,
    ])
        {{ Form::hidden('act_id', $act_id) }}
        {{ Form::hidden('character_id', $character_id) }}
        {{ Form::hidden('value', '10') }}

        <div class="form-group">
            {{ Form::label('copy', 'Copy') }}
            {{ Form::textarea('copy', $instruction->copy, array(
                'class' => 'form-control',
                'rows' => '3',
            )) }}
        </div>
    @endcomponent
</div>
