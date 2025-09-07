<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $booking_number
 * @property int $package_id
 * @property int $pilgrim_id
 * @property float $total_amount
 * @property float $paid_amount
 * @property float $remaining_amount
 * @property string $payment_status
 * @property string $booking_status
 * @property \Carbon\Carbon $booking_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Package $package
 * @property-read \App\Models\Pilgrim $pilgrim
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking unpaid()
 * @method static \Database\Factories\BookingFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_number',
        'package_id',
        'pilgrim_id',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'payment_status',
        'booking_status',
        'booking_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'booking_date' => 'date',
    ];

    /**
     * Get the package for this booking.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the pilgrim for this booking.
     */
    public function pilgrim(): BelongsTo
    {
        return $this->belongsTo(Pilgrim::class);
    }

    /**
     * Get the payments for this booking.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include unpaid or partially paid bookings.
     */
    public function scopeUnpaid($query)
    {
        return $query->whereIn('payment_status', ['pending', 'partial']);
    }
}