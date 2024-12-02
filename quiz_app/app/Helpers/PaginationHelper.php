<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class PaginationHelper
{
    public function paginateData($categories, $request)
    {
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedCategories = new LengthAwarePaginator(
            array_slice($categories, ($currentPage - 1) * $perPage, $perPage),
            count($categories),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        return $pagedCategories;
    }
}


