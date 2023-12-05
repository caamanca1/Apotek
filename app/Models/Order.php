<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    protected $fillable = [
      'user_id',
      'medicines',
      'name_customer',
      'total_price',
    ];

    protected $casts = [
        'medicines' => 'array',
    ];

    public function user() {
        // menghubungkan ke primary key nya
        // dalam kurung merupakan nama model tempat penyimpanan dari PK nya si FK ynang ada di model ini
        return $this->belongsTo(User::class);
    }

    // public function getCreatedAtAttribute() {
    //     return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
    // }
}


