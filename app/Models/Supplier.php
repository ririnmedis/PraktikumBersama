<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Tentukan atribut yang dapat diisi
    protected $fillable = [
        'supplier_name',     // Nama supplier
        'supplier_address',  // Alamat supplier
        'phone',             // Nomor telepon supplier
        'comment',           // Komentar tambahan
    ];

    // Relasi dengan model Product
    public function products()
    {
        return $this->hasMany(Product::class); // Relasi one-to-many
    }
}
