<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CharacterRequest;
use App\Models\Character;

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
            'resources' => Character::all()->sortBy('begins'),
            'columns' => [
                'title',
                'begins',
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
            route('acts.store'),
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
        $character = Character::create([
            'title' => $request->input('title'),
            'begins' => $request->input('begins'),
        ]);

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
            route('acts.update', $id),
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
        Character::find($id)->update([
            'title' => $request->input('title'),
            'begins' => $request->input('begins'),
        ]);

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

        return redirect()->route('acts.index');
    }

    /**
     * Show the form for editing the specified character.
     *
     * @param  App\Models\Character  $character
     * @param  string  $url
     * @param  string  $method
     * @param  string  $action
     * @return \Illuminate\Http\Response
     */
    private function editForm(Character $character, string $url, string $method, string $action) {
        return View::make('admin.character.edit')->with([
            'character' => $character,
            'url' => $url,
            'method' => $method,
            'action' => $action,
        ]);
    }
}
