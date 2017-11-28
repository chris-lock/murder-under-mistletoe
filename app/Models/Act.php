<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Act extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('begins');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'begins',
        'story_id',
    ];

    /**
     * What happens?
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructions()
    {
        return $this->hasMany('Models\Instruction');
    }
}
