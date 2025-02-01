<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','section_id'];
    public function members()
    {
        return $this->hasMany(member::class);
    }
    public function sections()
    {
        return $this->belongsTo(section::class);
    }
}
