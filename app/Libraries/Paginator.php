<?php

namespace App\Libraries;

use Illuminate\Database\Eloquent\Builder;

class Paginator
{
    protected Builder $query;
    protected int $perPage;
    protected int $currentPage;

    public function __construct(Builder $query, int $perPage = 25, int $currentPage = 1)
    {
        $this->query = $query;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
    }

    public function paginate(): array
    {
        dd($this->query->get());
        return [
            [
                'page_size' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_entries' => $this->totalCount(),
                'total_pages' => $this->getTotalPages(),
            ],

        ];
    }

    public function getTotalPages(): int
    {
        $totalCount = $this->totalCount();
        if ($totalCount == 0) {
            return 0;
        }
        return ceil($this->totalCount() / $this->perPage());
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    protected function currentPage(): int
    {
        return $this->currentPage;
    }

    protected function totalCount(): int
    {
        return $this->query->toBase()->getCountForPagination();
    }
}