<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admins'; // Specify the table name if it's not 'admins'

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', // Hide the password when the model is serialized
    ];
}
