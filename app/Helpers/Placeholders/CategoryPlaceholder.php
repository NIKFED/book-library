<?php

namespace App\Helpers\Placeholders;

use App\Models\Dictionaries\Category;

class CategoryPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    protected function fillInstance()
    {
        $this->instance?->fill([
            'name' => $this->fillable['category'],
        ]);
    }

    public function getInstance(): bool
    {
        $name = $this->fillable['category'];
        $model = Category::query()->where('name', $name)->first();
        if (!$model) {
            $this->instance = new Category();
            return true;
        }
        $this->instance = $model;
        return false;
    }
}