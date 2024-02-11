<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\Orderable;
use App\Traits\Searchable;
use App\Traits\Filterable;

class Plant extends Model
{
    use HasFactory, Orderable, Searchable, Filterable;

    protected $fillable = [
        'name',
        'type',
        'age',
        'location',
        'location_xy',
        'planned_at',
        'manager',
        'code',
        'blueprint',
        'quarter_id',
    ];

    public function quarter(): BelongsTo
    {
        return $this->belongsTo(Quarter::class);
    }
}
