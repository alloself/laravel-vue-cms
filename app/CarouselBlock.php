<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselBlock extends Model
{
    protected $fillable = ['title', 'content', 'order'];

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
    public function pages()
    {
        return $this->morphToMany(Page::class, 'pageable');
    }
}
