<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_reset_tokens';
  protected $primaryKey = 'email'; // Specify the column used as the primary key
    public $incrementing = false; // Indicate that it is not an auto-incrementing field
    protected $keyType = 'string'; // Specify the type if it's not an integer
    protected $fillable = ['otp','user_id','email'];
}
