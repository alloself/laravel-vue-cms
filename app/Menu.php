<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use NodeTrait;

    protected $fillable = [
        'title', 'order'
    ];

    public function link()
    {
        return $this->morphToMany(Page::class, 'linkable');
    }
}
