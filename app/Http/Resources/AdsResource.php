<?php

namespace App\Http\Resources;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
            'image' => $this->image,
          'link' =>$this->link,
            'member_id' => $this->member_id,
            'status' =>$this->status,
            'discount' => $this->discount,
            'member' => $this->member,

    ];
    }
}
