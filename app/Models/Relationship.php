<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'character_id',
        'relationship_id',
    ];

    /**
     * New phone who dis?
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function character()
    {
        return $this->hasOne('App\Models\Character', 'id', 'relationship_id');
    }
}
