<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InventoryItem
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string|null $description
 * @property string $category
 * @property float $cost_price
 * @property float $selling_price
 * @property int $quantity_in_stock
 * @property int $reorder_level
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem active()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem lowStock()
 * @method static \Database\Factories\InventoryItemFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class InventoryItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'cost_price',
        'selling_price',
        'quantity_in_stock',
        'reorder_level',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'reorder_level' => 'integer',
    ];

    /**
     * Scope a query to only include active items.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include items with low stock.
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('quantity_in_stock <= reorder_level');
    }
}