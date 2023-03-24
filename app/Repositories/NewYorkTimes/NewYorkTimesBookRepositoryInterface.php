<?php

namespace App\Repositories\NewYorkTimes;

use App\Dto\BestSellingBook\BestSellerBookDto;
use App\Dto\BestSellingBook\BestSellerBookFilterDto;

interface NewYorkTimesBookRepositoryInterface
{
    /**
     * @param BestSellerBookFilterDto $filter
     *
     * @return null|BestSellerBookDto
     */
    public function getBestSellerBooksByFilter(BestSellerBookFilterDto $filter): ?array;
}
