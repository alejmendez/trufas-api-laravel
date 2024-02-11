<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'blueprint',
        'quarter_id',
    ];

    public function field()
    {
        return $this->quarter->field();
    }

    public function quarter(): BelongsTo
    {
        return $this->belongsTo(Quarter::class);
    }
}
