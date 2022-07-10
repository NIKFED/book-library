<?php

namespace App\Helpers\Placeholders;

use Illuminate\Database\Eloquent\Model;

abstract class Placeholder
{
    protected Model $instance;
    protected array $fillable;

    abstract function getInstance() : bool;

    protected function fillInstance()
    {
        $this->instance->fill($this->fillable);
    }

    protected function saveInstance()
    {
        $this->instance->save();
    }

    public function CFS()
    {
        if ($this->getInstance()) { // Берем сущность (если её нет - то создаем)
            $this->fillInstance(); // То заполняем её
            $this->saveInstance(); // И сохраняем
        }
    }

    public function getInstanceId(): ?int
    {
        if (isset($this->instance)) {
            return $this->instance->id;
        }
        return null;
    }
}