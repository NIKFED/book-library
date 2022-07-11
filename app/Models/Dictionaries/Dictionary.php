<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dictionaries\Dictionary
 *
 * @property string $name
 * @mixin \Eloquent
 */
class Dictionary extends  Model
{
    protected $fillable = [
        'name',
    ];
}