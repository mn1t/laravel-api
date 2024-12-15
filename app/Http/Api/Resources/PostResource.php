<?php

namespace App\Http\Api\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'comments' => $this->comments->count(),
            'created' => Carbon::parse($this->created_at)->format('d.m.y'),
            'author' => $this->user->name,
        ];
    }
}
