<?php

namespace App\Helpers\Placeholders;

use App\Models\Book;

class BookPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    public function getInstance(): bool
    {
        try {
            $isbn = $this->fillable['isbn'];
            $model = Book::query()->where('isbn', $isbn)->first();
            if (!$model) {
                $this->instance = new Book();
                return true;
            }
            $this->instance = $model;
            return false;
        } catch (\Exception) {
            dd($this->fillable);
        }
    }
}