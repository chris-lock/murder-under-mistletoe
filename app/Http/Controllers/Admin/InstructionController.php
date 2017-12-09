<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\InstructionRequest;
use App\Models\Instruction;

class InstructionController extends AdminController
{
    /**
     * Store a newly created instruction in storage.
     *
     * @param  \App\Http\Requests\InstructionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructionRequest $request)
    {
        $instruction = Instruction::create($request->all());

        return $this->redirectToCharacter(
            $instruction->character_id,
            $instruction->act_id
        );
    }

    /**
     * Update the specified instruction in storage.
     *
     * @param  \App\Http\Requests\InstructionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstructionRequest $request, int $id)
    {
        $instruction = Instruction::find($id);
        $instruction->update($request->all());

        return $this->redirectToCharacter(
            $instruction->character_id,
            $instruction->act_id
        );
    }

    /**
     * Remove the specified instruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $instruction = Instruction::find($id);
        $character_id = $instruction->character_id;
        $instruction->delete();

        return $this->redirectToCharacter($character_id);
    }

    /**
     * Redirect to the character page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function redirectToCharacter(int $id, ?int $return_id = null) {
        return redirect()->route('characters.edit', [
            'character' => $id,
            'panel' => 'instructions',
            $return_id
                ? '#act-' . $return_id
                : '',
        ]);
    }
}
