<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TravelSetting
 *
 * @property int $id
 * @property string $travel_name
 * @property string|null $travel_logo
 * @property string $travel_address
 * @property string $travel_email
 * @property string $travel_phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TravelSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelSetting query()
 * @method static \Database\Factories\TravelSettingFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class TravelSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'travel_name',
        'travel_logo',
        'travel_address',
        'travel_email',
        'travel_phone',
    ];
}