@inject('instruction', 'App\Models\Instruction')

<div class="panel-heading" id="act-{{ $act->id }}">
    {{ $act->title }}
</div>

<div class="panel-body">
    @foreach ($act->instructions as $instruction)
        @include('admin.character.instruction', [
            'instruction' => $instruction,
            'act_id' => $act->id,
            'character_id' => $character_id,
        ])
    @endforeach

    @include('admin.character.instruction', [
        'instruction' => new $instruction,
        'act_id' => $act->id,
        'character_id' => $character_id,
    ])
</div>
