<?php

namespace App\Repositories\NewYorkTimes;

use App\Dto\BestSellingBook\BestSellerBooksDto;
use App\Dto\BestSellingBook\BestSellerBooksFilterDto;

interface NewYorkTimesBookRepositoryInterface
{
    /**
     * @param BestSellerBooksFilterDto $filter
     *
     * @return null|BestSellerBooksDto
     */
    public function getBestSellerBooksByFilter(BestSellerBooksFilterDto $filter): ?array;
}
