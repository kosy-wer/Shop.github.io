<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
	use HasFactory;
	protected $table = 'Product'; // Nama tabel yang terkait dengan model

    protected $fillable = [
        'Product_Name',
        'Price',
        'Description',
        // tambahkan kolom lain yang ingin diisi secara massal
    ];
}
