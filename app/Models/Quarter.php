<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\Orderable;
use App\Traits\Searchable;
use App\Traits\Filterable;

class Quarter extends Model
{
    use HasFactory, Orderable, Searchable, Filterable;

    protected $fillable = [
        'name',
        'area',
        'planned_at',
        'blueprint',
        'field_id',
    ];

    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function getCountPlantsAttribute(): int
    {
        return $this->plants->count();
    }
}
