<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Act;
use App\Models\Character;

class CharacterInstructionController extends Controller
{
    public function index(string $slug)
    {
        return Act::withInstructionsForCharacter(
            Character::where('slug', '=', $slug)->first()->id
        )->get();
    }
}
