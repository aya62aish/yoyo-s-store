<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\member;

class ad extends Model
{

    protected $table = 'ads';
    protected $fillable = ['title','member_id','description','image','status'];
    public function member()
    {
        return $this->belongsTo(member::class);
    }
}
