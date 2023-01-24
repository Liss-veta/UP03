<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_user' => $this->id_user,
            'text' => $this->text,
            'images' => $this->images,
            'category' => $this->category,
            'comments' => CommentResource::collection($this->comments),
            'users' => $this->users,
            'likes' => $this->likes,
            'video_url' => $this->video_url,
            'preview' => $this->preview,
            'created_at' => $this->created_at,
        ];
    }
}
