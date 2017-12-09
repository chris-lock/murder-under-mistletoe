<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;

class Character extends Model
{
    use HasSlug;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guest',
        'email',
        'involvement',
        'notes',
        'costume',
        'first_name',
        'last_name',
        'bio',
        'appearance',
        'story',
        'murder',
    ];
     /**
     * The attributes appended to JSON.
     *
     * @var array
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * Get the options for generating the slug.
     *
     * @return SlugOptions
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the chracter's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getInstructionsAndRelationshipsAttribute()
    {
        return "{$this->instructions()->distinct()->count('act_id')}-{$this->relationships()->count()}";
    }

    /**
     * Who you know?
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relationships()
    {
        return $this->hasMany('App\Models\Relationship');
    }

    /**
     * What do people think of you?
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perceptions()
    {
        return $this->hasMany('App\Models\Relationship', 'relationship_id', 'id');
    }

    /**
     * What should you do?
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructions()
    {
        return $this->hasMany('App\Models\Instruction');
    }
}
