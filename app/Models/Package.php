<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property int $package_type_id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property int $duration_days
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $capacity
 * @property int $available_slots
 * @property array|null $inclusions
 * @property array|null $exclusions
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PackageType $packageType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package active()
 * @method static \Database\Factories\PackageFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'package_type_id',
        'name',
        'description',
        'price',
        'duration_days',
        'start_date',
        'end_date',
        'capacity',
        'available_slots',
        'inclusions',
        'exclusions',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'duration_days' => 'integer',
        'capacity' => 'integer',
        'available_slots' => 'integer',
    ];

    /**
     * Get the package type that owns this package.
     */
    public function packageType(): BelongsTo
    {
        return $this->belongsTo(PackageType::class);
    }

    /**
     * Get the bookings for this package.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Scope a query to only include active packages.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}