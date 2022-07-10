<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BookCategory
 *
 * @property int $id
 * @property int $book_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookCategory extends Model
{
    protected $fillable = [
        'book_id',
        'category_id',
    ];
}
