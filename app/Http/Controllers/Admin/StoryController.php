<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoryRequest;
use App\Models\Story;

class StoryController extends AdminController
{
    /**
     * Redirect to create or update depending on whether a story exists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::all()->first();

        return ($story === null)
            ? $this->create()
            : $this->edit($story->id);
    }
    /**
     * Show the form for creating a new story.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return $this->editForm(new Story);
    }

    /**
     * Store a newly created story in storage.
     *
     * @param  \App\Http\Requests\StoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = Story::create($request->all());

        return $this->edit($story->id);
    }

    /**
     * Display the specified story.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified story.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return $this->editForm(Story::find($id));
    }

    /**
     * Update the specified story in storage.
     *
     * @param  \App\Http\Requests\StoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, int $id)
    {
        Story::find($id)->update($request->all());

        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified story.
     *
     * @param  App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    private function editForm(Story $story) {
        return View::make('admin.story.edit')->with([
            'resource' => $story,
            'prevent_destory' => true,
        ]);
    }
}
