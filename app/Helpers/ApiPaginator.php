<?php

namespace App\Helpers;

class ApiPaginator
{
    public $currentPage;
    public $totalPages;
    public $totalResults;
    public $hasPages;

    public function __construct($currentPage, $totalPages, $totalResults)
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->totalResults = $totalResults;
        $this->hasPages = $totalPages > 1;
    }

    public function hasPages()
    {
        return $this->hasPages;
    }

    public function currentPage()
    {
        return $this->currentPage;
    }

    public function lastPage()
    {
        return $this->totalPages;
    }

    public function total()
    {
        return $this->totalResults;
    }
} 