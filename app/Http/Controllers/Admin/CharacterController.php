<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Models\Act;

class CharacterController extends AdminController
{
    /**
     * Display a listing of the character.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.component.index')->with([
            'controller' => 'Character',
            'resources' => Character::all(),
            'columns' => [
                'guest',
                'first_name',
                'last_name',
            ],
        ]);
    }

    /**
     * Show the form for creating a new character.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->editForm(
            new Character,
            route('characters.store'),
            'POST',
            'Create'
        );
    }

    /**
     * Store a newly created character in storage.
     *
     * @param  \App\Http\Requests\CharacterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterRequest $request)
    {
        $character = Character::create($request->all());

        return $this->edit($character->id);
    }

    /**
     * Show the form for editing the specified character.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->editForm(
            Character::find($id),
            route('characters.update', $id),
            'PUT',
            'Update'
        );
    }

    /**
     * Update the specified character in storage.
     *
     * @param  \App\Http\Requests\CharacterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CharacterRequest $request, $id)
    {
        Character::find($id)->update($request->all());

        return $this->edit($id);
    }

    /**
     * Remove the specified character from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Character::find($id)->delete();

        return redirect()->route('characters.index');
    }

    /**
     * Show the form for editing the specified character.
     *
     * @param  App\Models\Character  $character
     * @param  string  $url
     * @param  string  $method
     * @param  string  $submit
     * @return \Illuminate\Http\Response
     */
    private function editForm(Character $character, string $url, string $method, string $submit) {
        return View::make('admin.character.edit')->with([
            'resource_name' => 'Character',
            'resource' => $character,
            'url' => $url,
            'method' => $method,
            'submit' => $submit,
            'acts' => Act::all(),
            'instructions' => $character->instructions->groupBy('act_id'),
            'relationships' => $character->instructions->groupBy('act_id'),
        ]);
    }
}
