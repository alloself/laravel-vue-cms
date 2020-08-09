<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextBlock extends Model
{
    protected $fillable = ['title', 'content'];

    public function pages()
    {
        return $this->morphToMany(Page::class, 'pageable');
    }
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
