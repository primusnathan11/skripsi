<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreeType extends Model
{
    use HasFactory;

    protected $table = "tree_types";

    protected $fillable = [
        'partner_id',
        'name',
        'description',
        'sequestration',
        'is_adopted',
        'project_id',
    ];

    protected $with = ['partner'];

    protected $visible = [
        'id',
        'name',
        'description',
        'partner',
        'is_adopted',
        'project_id',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function project()
    {
        return $this->belongsTo(Partner::class, 'project_id');
    }
}
