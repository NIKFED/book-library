<?php

namespace App\Http\Controllers\Traits;

use App\Libraries\Paginator;
use Illuminate\Database\Eloquent\Builder;

trait Paginatable
{
    protected function getPaginator(Builder $query): Paginator
    {
        $perPage = $this->request->get('page_size', 30);
        $currentPage = $this->request->get('current_page', 1);
        return new Paginator($query, $perPage, $currentPage);
    }
}