<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Orderable
{

    public function scopeOrder(Builder $query, String $order = ''): void
    {
        if ($order === '') {
            return;
        }

        $order = explode(',', $order);
        foreach ($order as $col) {
            $firstChar = substr(trim($col), 0, 1);
            $direction = 'asc';
            if ($firstChar === '-') {
                $col = substr($col, 1);
                $direction = 'desc';
            }
            $query->orderBy($col, $direction);
        }
    }
}
