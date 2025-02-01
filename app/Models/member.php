<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = 'members';
    protected $fillable = ['name','location','status','whatsapp','phone','category_id','facebook','icon', 'cover'];
    public function reviews()
    {
        return $this->hasMany(review::class);
    }

    public function ads()
    {
        return $this->hasMany(ad::class);
    }
    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'member_id', 'user_id')
            ->withTimestamps();
    }
}
