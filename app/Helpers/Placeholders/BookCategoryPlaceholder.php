<?php

namespace App\Helpers\Placeholders;

use App\Models\BookCategory;

class BookCategoryPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    public function getInstance(): bool
    {
        $bookId = $this->fillable['book_id'];
        $categoryId = $this->fillable['category_id'];
        $model = BookCategory::query()
            ->where('book_id', $bookId)
            ->where('category_id', $categoryId)
            ->first();
        if (!$model) {
            $this->instance = new BookCategory();
            return true;
        }
        $this->instance = $model;
        return false;
    }
}