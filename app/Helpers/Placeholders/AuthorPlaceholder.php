<?php

namespace App\Helpers\Placeholders;


use App\Models\Dictionaries\Author;

class AuthorPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    protected function fillInstance()
    {
        $this->instance?->fill([
            'full_name' => $this->fillable['author'],
        ]);
    }

    public function getInstance(): bool
    {
        $fullName = $this->fillable['author'];
        $model = Author::query()->where('full_name', $fullName)->first();
        if (!$model) {
            $this->instance = new Author();
            return true;
        }
        $this->instance = $model;
        return false;
    }
}