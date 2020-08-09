<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Page extends Model
{
  use NodeTrait, Sluggable {
    NodeTrait::replicate as replicateNode;
    Sluggable::replicate as replicateSlug;
  }
  public function replicate(array $except = null)
  {
    $instance = $this->replicateNode($except);
    (new SlugService())->slug($instance, true);

    return $instance;
  }
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
        'onUpdate' => true
      ]
    ];
  }

  public function generatePath()
  {
    if ($this->isRoot()) {
      $this->path = $this->slug;
    } else {
      if ($this->parent->path == '/') {
        $this->path = $this->slug;
      } else {
        $this->path = $this->parent->path . '/' . $this->slug;
      }
    }
    return $this;
  }
  protected $fillable = [
    'title', 'slug', 'keywords', 'description', 'path', 'index_page', 'parent_id'
  ];

  public function textBlocks()
  {
      return $this->morphedByMany(TextBlock::class, 'pageable');
  }

}
