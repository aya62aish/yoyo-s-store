<?php

namespace App\Http\Resources;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourse extends JsonResource
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
            'category name' => $this->name,
            'category icon' => $this->icon,
            'section name' =>section::find($this->section_id)->name,
        ];
    }
}
