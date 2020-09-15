<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'content' => $this->content,
            'datetime' => $this->datetime,
            'cover' => $this->cover,
            'status' => $this->status,
            'articleid' => $this->articleid
        ];
    }
}
