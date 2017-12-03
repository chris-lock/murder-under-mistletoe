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
        Relationship::create($request->all())->character_id;

        return $this->redirectToCharacter(
            $request->input('character_relationship_id'),
            $request->input('return_id')
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
        Relationship::find($id)->update($request->all());

        return $this->redirectToCharacter(
            $request->input('character_relationship_id'),
            $request->input('return_id')
        );
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

        return $this->redirectToCharacter(
            $request->input('character_relationship_id')
        );
    }

    /**
     * Redirect to the character page.
     *
     * @param  int  $id
     * @param  ?int  $return_id
     * @return \Illuminate\Http\Response
     */
    private function redirectToCharacter(int $id, ?int $return_id) {
        return redirect()->route('characters.edit', [
            'character' => $id,
            'panel' => 'relationships',
            isset($return_id)
                ? '#relationship-' . $return_id
                : '',
        ]);
    }
}
