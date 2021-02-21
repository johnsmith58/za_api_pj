<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\BookRatingResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;
        $resource->user = new UserResource($this->user);
        $resource->reviews = BookReviewResource::collection($this->reviews);
        $resource->ratings = BookRatingResource::collection($this->ratings);
        return $resource;
    }
}
