<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $return = 'object';

    protected $fillable = [
        'name',
        'description',
        'address',
        'photo',
        'user_id',
        'parner_id',
        'planting_date',
    ];

    // protected $with = ['type'];

    protected $visible = [
        'name',
        'description',
        'address',
        'photo',
        'user_id',
        'parner_id',
        'planting_date',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
