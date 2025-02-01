<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    protected $table = 'favorites';
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function member()
    {
        return $this->hasOne(member::class);
    }
}
