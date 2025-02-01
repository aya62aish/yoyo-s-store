<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $table = 'sections';
    public function category()
    {
        return $this->hasMany(category::class);
    }
}