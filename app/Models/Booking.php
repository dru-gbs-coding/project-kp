<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_booking',
        'user_id',
        'layanan_id',
        'tanggal_booking',
        'tanggal_pengiriman',
        'asal',
        'tujuan',
        'detail_barang',
        'berat_barang',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_booking' => 'date',
        'tanggal_pengiriman' => 'date',
    ];

    /**
     * Boot method to auto-generate kode_booking.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_booking)) {
                $model->kode_booking = self::generateKodeBooking();
            }
            if (empty($model->tanggal_booking)) {
                $model->tanggal_booking = now()->toDateString();
            }
        });
    }

    /**
     * Generate unique booking code format: JTA-YYYYMMDD-XXXX
     */
    public static function generateKodeBooking(): string
    {
        do {
            $kode = 'JTA-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (self::where('kode_booking', $kode)->exists());

        return $kode;
    }

    /**
     * Get the user who made the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the service for this booking.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    /**
     * Get the status history for this booking.
     */
    public function statusHistories(): HasMany
    {
        return $this->hasMany(StatusBooking::class, 'booking_id', 'booking_id');
    }
}
