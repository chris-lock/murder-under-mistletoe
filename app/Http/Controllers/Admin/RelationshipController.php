<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\RelationshipRequest;
use App\Models\Relationship;

class RelationshipController extends AdminController
{
    /**
     * Store a newly created relationship in storage.
     *
     * @param  \App\Http\Requests\RelationshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelationshipRequest $request)
    {
        return $this->redirectToCharacter(
            Relationship::create($request->all())->character_id
        );
    }

    /**
     * Update the specified relationship in storage.
     *
     * @param  \App\Http\Requests\RelationshipRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RelationshipRequest $request, int $id)
    {
        $relationship = Relationship::find($id);
        $relationship->update($request->all());

        return $this->redirectToCharacter($relationship->character_id);
    }

    /**
     * Remove the specified relationship from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $relationship = Relationship::find($id);
        $character_id = $relationship->character_id;
        $relationship->delete();

        return $this->redirectToCharacter($character_id);
    }

    /**
     * Redirect to the character page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function redirectToCharacter(int $id) {
        return redirect()->route('characters.edit', [
            'character' => $id,
            'panel' => 'relationships',
        ]);
    }
}
