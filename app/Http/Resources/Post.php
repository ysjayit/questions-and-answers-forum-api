<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Comment;
use App\Http\Resources\User;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'title'     => $this->title,
            'content'   => $this->content,
            'date'      => $this->date,
            'status'    => $this->status,
            'created_at'=> $this->created_at->format('d/m/Y'),
            'updated_at'=> $this->updated_at->format('d/m/Y'),
            'comments'  => Comment::collection($this->comments),
            'user'      => User::make($this->user),
        ];
    }
}
