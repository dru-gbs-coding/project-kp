<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'layanan_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'estimasi_waktu',
    ];

    /**
     * Get the bookings for this service.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'layanan_id', 'layanan_id');
    }
}
