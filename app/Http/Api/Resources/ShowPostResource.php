<?php

namespace App\Http\Api\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostResource extends JsonResource
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
            'created' => Carbon::parse($this->created_at)->format('d.m.y'),
            'author' => $this->user->name,
            'likes' => $this->likes->count(),
            'comments' => $this->comments->sortBy('created_at')->select(['id', 'message', 'user_id', 'created_at']),
        ];
    }
}
