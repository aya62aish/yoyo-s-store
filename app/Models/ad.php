<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\member;

class ad extends Model
{

    protected $table = 'ads';
    protected $fillable = ['title','member_id','description','image','status','discount'];
    public function member()
    {
        return $this->belongsTo(member::class);
    }
    public function banners(){
        return $this->hasMany('App\Models\banners','ad_id');
    }
}
