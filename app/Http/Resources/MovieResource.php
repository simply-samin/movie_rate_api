<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'movie_id' => $this->id,
            'title' => $this->title,
            'release_year' => $this->release_year,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'genre' => $this->genre,
            'average_rating' => $this->average_rating,
            'total_ratings' => $this->total_ratings,
            'created_at' => $this->created_at
        ];
    }
}
