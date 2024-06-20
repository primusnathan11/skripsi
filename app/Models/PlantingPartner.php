<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantingPartner extends Model
{
    protected $table = "planting_partners";

    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    use HasFactory;
}
