<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'location',
        'detail_location',
    ];

    /**
     * Get the item that owns the inventory.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
