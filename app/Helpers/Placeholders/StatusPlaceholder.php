<?php

namespace App\Helpers\Placeholders;

use App\Models\Dictionaries\Status;

class StatusPlaceholder extends Placeholder
{
    public function __construct(array $fillable)
    {
        $this->fillable = $fillable;
    }

    protected function fillInstance()
    {
        $this->instance?->fill([
            'name' => $this->fillable['status'],
        ]);
    }

    public function getInstance(): bool
    {
        $name = $this->fillable['status'];
        $model = Status::query()->where('name', $name)->first();
        if (!$model) {
            $this->instance = new Status();
            return true;
        }
        $this->instance = $model;
        return false;
    }
}