<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        return $this->editForm(
            new Story,
            route('stories.store'),
            'POST',
            'Create'
        );
    }

    /**
     * Store a newly created story in storage.
     *
     * @param  \App\Http\Requests\StoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = Story::create([
            'title' => $request->input('title'),
            'begins' => $request->input('begins'),
            'copy' => $request->input('copy'),
        ]);

        return $this->edit($story->id);
    }

    /**
     * Display the specified story.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified story.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->editForm(
            Story::find($id),
            route('stories.update', $id),
            'PUT',
            'Update'
        );
    }

    /**
     * Update the specified story in storage.
     *
     * @param  \App\Http\Requests\StoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, $id)
    {
        Story::find($id)->update([
            'title' => $request->input('title'),
            'begins' => $request->input('begins'),
            'copy' => $request->input('copy'),
        ]);

        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified story.
     *
     * @param  App\Models\Story  $story
     * @param  string  $url
     * @param  string  $method
     * @param  string  $button
     * @return \Illuminate\Http\Response
     */
    private function editForm(Story $story, string $url, string $method, string $button) {
        return View::make('admin.story.edit')->with([
            'story' => $story,
            'url' => $url,
            'method' => $method,
            'button' => $button,
        ]);
    }
}
