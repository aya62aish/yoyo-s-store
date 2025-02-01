<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class member extends Model
{
    protected $table = 'members';
    public function reviews()
    {
        return $this->hasMany(review::class);
    }
    public function favorites()
    {
        return $this->hasOne(favorite::class);
    }
    public function ads()
    {
        return $this->hasMany(ad::class);
    }
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}