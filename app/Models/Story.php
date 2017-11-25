<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'begins',
        'copy',
    ];

    /**
     * How things unfold.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acts()
    {
        return $this->hasMany('Models\Act');
    }
}
