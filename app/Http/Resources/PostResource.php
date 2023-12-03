<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
            'user' => $this->user,
            'assets' => $this->getMedia()->map(fn (Media $media) =>
            [
                'url' => $media->getUrl(),
                'type' => explode('/', $media->mime_type)[0]
            ]),
            'main_comment' => $this->main_comment
        ];
    }
}