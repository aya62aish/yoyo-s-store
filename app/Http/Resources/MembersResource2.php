<?php

namespace App\Http\Resources;

use App\Models\ad;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembersResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'icon' =>$this->icon,
            'status' => $this->status,
            'cover' => $this->cover,
            'phone' =>$this->phone,
            'location' => $this->location,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'discount' => ad::where('member_id', $this->id)->max('discount'),
            'ads' => ad::where('member_id',$this->id)->get(),
            'rating' => review::where('member_id',$this->id)->get()->avg('rate'),
            'number of reviews' => review::where('member_id',$this->id)->get()->count()
        ];
    }
}
