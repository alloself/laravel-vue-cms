<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardBlock extends Model
{
    protected $fillable = ['title', 'content', 'horizontal'];

    public function pages()
    {
        return $this->morphToMany(Page::class, 'pageable');
    }
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
    public function link()
    {
        return $this->morphToMany(Page::class, 'linkable');
    }
}
