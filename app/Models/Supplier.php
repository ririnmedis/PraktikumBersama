<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Tentukan atribut yang dapat diisi
    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'phone',
        'comment',
    ];
}
