<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tree extends Model
{
    use HasFactory;

    protected $table = "trees";
    protected $return = 'object';

    protected $fillable = [
        'type_id',
        'code',
        'plant_number',
        'description',
        'planting_date',
        'image',
        'condition',
        'latitude',
        'longitude',
    ];

    protected $with = ['type'];

    protected $visible = [
        'id',
        'type_id',
        'code',
        'plant_number',
        'description',
        'planting_date',
        'image',
        'condition',
        'latitude',
        'longitude',
    ];

    // cast 
    protected $casts = [
        'planting_date' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function type()
    {
        return $this->belongsTo(TreeType::class, 'type_id');
    }
}
