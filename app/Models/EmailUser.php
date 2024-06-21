<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailUser extends Model
{

    use HasFactory;
    protected $table = 'email_users';

    protected $fillable = [
        'id',
        'email',
        'name'
    ];
}
