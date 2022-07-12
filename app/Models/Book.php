<?php

namespace App\Models;

use App\Models\Dictionaries\Author;
use App\Models\Dictionaries\Category;
use App\Models\Dictionaries\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property string $title
 * @property string $isbn
 * @property int $page_count
 * @property string|null $thumbnail_url
 * @property string|null $short_description
 * @property string|null $long_description
 * @property \Illuminate\Support\Carbon|null $published_date
 * @property int $book_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AuthorBook[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read Book $status
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePageCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublishedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereThumbnailUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'page_count',
        'thumbnail_url',
        'short_description',
        'long_description',
        'book_status_id',
        'published_date',
    ];

    protected $dates = [
        'published_date',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'book_status_id', 'id');
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id');
    }

    public function authorBooks(): HasMany
    {
        return $this->hasMany(AuthorBook::class, 'book_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id');
    }
}
