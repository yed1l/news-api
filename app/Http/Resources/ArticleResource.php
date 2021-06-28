<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'anons'=>$this->anons,
            'description'=>$this->body,
            'category'=>$this->category,
            'category_id'=>$this->category_id,
            'author'=>$this->author->name
        ];
    }
}
