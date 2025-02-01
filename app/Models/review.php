<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $table = 'reviews';
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function member()
    {
        return $this->belongsTo(member::class);
    }
    protected $fillable = ['member_id', 'rating', 'comment', 'user_id'];
}
