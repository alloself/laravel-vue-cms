<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'name', 'link'];

    public function link()
    {
        return $this->morphToMany(Page::class, 'linkable');
    }
}
