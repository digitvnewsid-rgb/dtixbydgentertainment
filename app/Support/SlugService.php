<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    public static function unique(string $value, Model $model, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $counter = 1;

        while (
            $model->newQuery()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where($column, $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
