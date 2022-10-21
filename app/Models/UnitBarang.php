<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBarang extends Model
{
    use HasFactory;

    protected $table = 'unit_barang';
    protected $guarded = [
        'id'
    ];
}
