<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    protected $fillable = [ 'title' ,'keywords','description','content','datetime','cover' ,'status','articleid'];


    public function article()
    {
        return $this->belongsTo('App\Article','id','id_name');
    }


}
