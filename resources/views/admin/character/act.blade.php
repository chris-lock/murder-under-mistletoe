@inject('instruction', 'App\Models\Instruction')

<div class="panel-heading">
    {{ $act->title }}
</div>

<div class="panel-body">
    @foreach ($act->instructions as $instruction)
        @include('admin.character.instruction', [
            'resource' => $instruction,
            'act_id' => $act->id,
            'character_id' => $character_id,
        ])
    @endforeach

    @include('admin.character.instruction', [
        'resource' => new $instruction,
        'act_id' => $act->id,
        'character_id' => $character_id,
    ])
</div>
