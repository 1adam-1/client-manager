<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class utilisateurs extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'username', 'email', 'password',
    ];
}

