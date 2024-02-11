<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    public function scopeFilter(Builder $query, Array $filters = []): void
    {
        if (count($filters) === 0) {
            return;
        }

        foreach ($filters as $col => $value) {
            $query->where($col, '=', $value);
        }
    }
}
