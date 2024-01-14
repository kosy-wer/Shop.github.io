<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
	use HasFactory;
	protected $table = 'Product';

    // Tentukan kolom yang dapat diisi

    // Jika tidak menggunakan timestamp
    public $timestamps = false;

    // Metode untuk mengambil data berdasarkan nama kolom
    public static function getcolumn($column)
    {
        return self::pluck($column);
    }
}
