<?php

namespace App\Repositories\NewYorkTimes;

use App\Dto\BestSellingBook\BestSellerBooksDto;
use App\Dto\BestSellingBook\BestSellerBooksFilterDto;
use App\Services\NewYorkTimesApiService;

class NewYorkTimesBookApiRepository implements NewYorkTimesBookRepositoryInterface
{
    /**
     * @param NewYorkTimesApiService $service
     */
    public function __construct(
        private NewYorkTimesApiService $service
    ) {
    }

    /**
     * @param BestSellerBooksFilterDto $filter
     *
     * @return null|BestSellerBooksDto
     */
    public function getBestSellerBooksByFilter(BestSellerBooksFilterDto $filter): ?array
    {
        return $this->service->getBestSellers($filter);
    }
}
