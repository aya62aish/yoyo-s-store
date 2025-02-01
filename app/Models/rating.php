<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $fillable = ['review', 'rating'];
    protected $table = 'ratings';
}
