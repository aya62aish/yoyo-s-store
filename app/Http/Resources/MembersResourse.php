<?php

namespace App\Http\Resources;

use App\Models\ad;
use App\Models\category;
use App\Models\favorite;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembersResourse extends JsonResource
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
            'name' => $this->name,
            'phone' =>$this-> phone,
            'location' =>$this->location,
            'whatsapp' => $this-> whatsapp,
            'facebook' => $this->facebook,
            'category' =>category::find($this->category_id)->name,
            'favorite' =>count(favorite::where('member_id',$this->id)->get()),
            'reviews' => count(review::where('member_id',$this->id)->get()),
            'ads' => ad::where('member_id',$this->id)->get(),
            // ask for retrive all data when fetich all members
        ];
    }
}