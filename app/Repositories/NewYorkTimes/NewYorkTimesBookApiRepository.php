<?php

namespace App\Repositories\NewYorkTimes;

use App\Dto\BestSellingBook\BestSellerBookDto;
use App\Dto\BestSellingBook\BestSellerBookFilterDto;
use App\Services\NewYorkTimesApiService;

/**
 * Repository class for NYT book entities
 *
 * In this implementation books are collected directly from NYT API
 */
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
     * Get Bestsellers books
     *
     * @param BestSellerBookFilterDto $filter
     *
     * @return null|BestSellerBookDto
     */
    public function getBestSellerBooksByFilter(BestSellerBookFilterDto $filter): ?array
    {
        return $this->service->getBestSellers($filter);
    }
}
