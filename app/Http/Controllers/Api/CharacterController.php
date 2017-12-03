<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;

class CharacterController extends Controller
{
    public function show(string $slug)
    {
        return Character::with(['relationships', 'relationships.character'])
            ->where('slug', '=', $slug)
            ->firstOrFail();
    }
}
