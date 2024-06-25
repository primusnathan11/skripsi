<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $primaryKey="id";
    protected $fillable = [
        'subject',
        'title',
        'image',
        'description',
        'link',
        'is_sent',
        'id_donation'
    ];
}
