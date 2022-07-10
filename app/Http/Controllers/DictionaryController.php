<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function config;

class DictionaryController extends ApiController
{
    private Request $request;
    private mixed $dictionaries;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->dictionaries = config('dictionaries.names');
    }

    public function getGroup(): JsonResponse|array
    {
        if (!$this->request->has('data')) {
            return $this->respondValidationError("Не передан список справочников");
        }
        $data = $this->request->get('data');
        $data = json_decode($data);
        $result = [];
        foreach ($data as $dictName) {
            if ($this->isValidDict($dictName)) {
                $result[$dictName] = $this->getDict($dictName);
            } else {
                return $this->respondNotFoundError("Справочник $dictName не найден");
            }
        }

        return $result;
    }

    private function getDict($dictName): array
    {
        $class = $this->getDictClass($dictName);
        $rows = $class->get();
        $sorted = $rows->sortBy($class->sortingField);
        $result = [];
        foreach ($sorted as $item) {
            $result[] = $item;
        }
        return $result;
    }

    private function isValidDict($dictName): bool
    {
        return array_key_exists($dictName, $this->dictionaries);
    }

    private function getDictClass($dictName): mixed
    {
        $className = $this->dictionaries[$dictName];
        return new $className;
    }
}