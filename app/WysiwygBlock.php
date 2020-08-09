<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WysiwygBlock extends Model
{
    protected $fillable = ['title', 'content'];

    public function pages()
    {
        return $this->morphToMany(Page::class, 'pageable');
    }
}
