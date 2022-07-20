<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'repair_type_id',
        'address',
    ];
}
