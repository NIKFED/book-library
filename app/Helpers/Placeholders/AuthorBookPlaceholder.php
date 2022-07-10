<?php

namespace App\Helpers\Placeholders;

use App\Models\AuthorBook;

class AuthorBookPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    public function getInstance(): bool
    {
        $bookId = $this->fillable['book_id'];
        $authorId = $this->fillable['author_id'];
        $model = AuthorBook::query()
            ->where('book_id', $bookId)
            ->where('author_id', $authorId)
            ->first();
        if (!$model) {
            $this->instance = new AuthorBook();
            return true;
        }
        $this->instance = $model;
        return false;
    }
}