<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ActRequest;
use App\Models\Act;

class ActController extends AdminController
{
    /**
     * Display a listing of the act.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.component.index')->with([
            'controller' => 'Act',
            'resources' => Act::all(),
            'columns' => [
                'title',
                'begins',
            ],
        ]);
    }

    /**
     * Show the form for creating a new act.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->editForm(new Act);
    }

    /**
     * Store a newly created act in storage.
     *
     * @param  \App\Http\Requests\ActRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActRequest $request)
    {
        $act = Act::create($request->all());

        return $this->edit($act->id);
    }

    /**
     * Show the form for editing the specified act.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return $this->editForm(Act::find($id));
    }

    /**
     * Update the specified act in storage.
     *
     * @param  \App\Http\Requests\ActRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActRequest $request, int $id)
    {
        Act::find($id)->update($request->all());

        return $this->edit($id);
    }

    /**
     * Remove the specified act from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Act::find($id)->delete();

        return redirect()->route('acts.index');
    }

    /**
     * Show the form for editing the specified act.
     *
     * @param  App\Models\Act  $act
     * @return \Illuminate\Http\Response
     */
    private function editForm(Act $act) {
        return View::make('admin.act.edit')->with([
            'resource' => $act,
        ]);
    }
}
