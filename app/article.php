<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    public function Post() {
    	
      return $this->hasMany('Post');
    }
}
