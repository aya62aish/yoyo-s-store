<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{

    protected $table = 'ads';
    public function members()
    {
        return $this->belongsTo(member::class);
    }
}