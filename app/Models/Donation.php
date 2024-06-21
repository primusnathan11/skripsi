<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = "donations";
    protected $primaryKey="id";
    protected $fillable = [
        'title',
        'image',
        'description',
        'target',
        'collected',
        'planting_date',
        'due_date',
        'planting_date',
        'is_published',
        'is_bingkaikarya',
        'status',
        'id_ukm',
        'nama_ukm',
        'id_location',
        'nama_lokasi',
        'id_mitra',
        'nama_mitra',
        'id_tree',
        'tree_name',
        'qr_code'
    ];
}
