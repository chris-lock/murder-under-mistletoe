<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        return $this->editForm(
            new Act,
            route('acts.store'),
            'POST',
            'Create'
        );
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
    public function edit($id)
    {
        return $this->editForm(
            Act::find($id),
            route('acts.update', $id),
            'PUT',
            'Update'
        );
    }

    /**
     * Update the specified act in storage.
     *
     * @param  \App\Http\Requests\ActRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActRequest $request, $id)
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
    public function destroy($id)
    {
        Act::find($id)->delete();

        return redirect()->route('acts.index');
    }

    /**
     * Show the form for editing the specified act.
     *
     * @param  App\Models\Act  $act
     * @param  string  $url
     * @param  string  $method
     * @param  string  $submit
     * @return \Illuminate\Http\Response
     */
    private function editForm(Act $act, string $url, string $method, string $submit) {
        return View::make('admin.act.edit')->with([
            'resource_name' => 'Act',
            'resource' => $act,
            'url' => $url,
            'method' => $method,
            'submit' => $submit,
        ]);
    }
}
