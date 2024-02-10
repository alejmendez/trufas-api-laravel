<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, String $search = ''): void
    {
        if ($search === '') {
            return;
        }

        foreach ($this->searchableColumns as $key => $column) {
            if ($key === 0) {
                $query->where($column, 'like', "%{$search}%");
            } else {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        }
    }
}
