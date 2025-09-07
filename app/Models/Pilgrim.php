<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Pilgrim
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $birth_date
 * @property string $gender
 * @property string $passport_number
 * @property \Carbon\Carbon $passport_expiry
 * @property string $nationality
 * @property string $address
 * @property string $emergency_contact_name
 * @property string $emergency_contact_phone
 * @property string|null $medical_conditions
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pilgrim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilgrim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilgrim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilgrim active()
 * @method static \Database\Factories\PilgrimFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Pilgrim extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'passport_number',
        'passport_expiry',
        'nationality',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'medical_conditions',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'passport_expiry' => 'date',
    ];

    /**
     * Get the bookings for this pilgrim.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Scope a query to only include active pilgrims.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}