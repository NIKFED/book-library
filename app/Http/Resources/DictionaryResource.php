<?php

namespace App\Http\Resources;

use App\Models\Dictionaries\Category;
use App\Models\Dictionaries\Dictionary;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class DictionaryResource extends JsonResource
{
    #[ArrayShape([
        'id' => "int",
        'name' => "string"
    ])]
    public function toArray($request): array
    {
        /** @var Dictionary $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
