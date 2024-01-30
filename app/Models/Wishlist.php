<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wishlists';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'created_at', 'updated_at'
    ];

    // Tambahan: Jika ingin menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    // ... tambahan kode model lainnya sesuai kebutuhan aplikasi Anda
}

