<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use App\Traits\Orderable;
use App\Traits\Searchable;
use App\Traits\Filterable;

class Field extends Model
{
    use HasFactory, Orderable, Searchable, Filterable;

    protected $fillable = [
        'name',
        'location',
        'size',
        'blueprint',
    ];

    public function quarters(): HasMany
    {
        return $this->hasMany(Quarter::class);
    }

    public function plants(): HasManyThrough
    {
        return $this->hasManyThrough(Plant::class, Quarter::class);
    }

    public function getCountPlantsAttribute(): int
    {
        return $this->plants->count();
    }

    public function getCountQuartersAttribute(): int
    {
        return $this->quarters->count();
    }
}
