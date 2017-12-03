<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        return Story::all()->first();
    }
}
