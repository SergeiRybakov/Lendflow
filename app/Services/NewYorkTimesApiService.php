<?php

namespace App\Services;

use App\Dto\BestSellingBook\BestSellerBooksDto;
use App\Dto\BestSellingBook\BestSellerBooksFilterDto;
use GuzzleHttp\Promise\PromiseInterface;
use App\Hydrators\Common\Hydrator;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NewYorkTimesApiService
{
    public function __construct(
        private string $apiUrl,
        private string $apiKey,
        private Hydrator $hydrator
    ) {
    }

    /**
     * Documentation for the method:
     * https://developer.nytimes.com/docs/books-product/1/routes/lists.json/get
     *
     * @param BestSellerBooksFilterDto $filterDto
     *
     * @return array|null
     */
    public function getBestSellers(BestSellerBooksFilterDto $filterDto): ?array
    {
        $result = [];
        $response = $this->apiRequest('/svc/books/v3/lists/best-sellers/history.json', $filterDto);
        if (
            $response->successful()
            && ($decoded = $response->json())
            && $decoded['status'] === 'OK'
            && $decoded['num_results'] > 0
        ) {
            foreach ($decoded['results'] as $book) {
                $result[] = $this->hydrator->hydrate(BestSellerBooksDto::class, $book, true);
            }
        }

        return $result;
    }

    /**
     * @param string $endPoint
     * @param BestSellerBooksFilterDto $filterDto
     *
     * @return PromiseInterface|Response
     */
    private function apiRequest(string $endPoint, BestSellerBooksFilterDto $filterDto): PromiseInterface|Response
    {
        $params = $this->prepareQueryParams($filterDto);

        if (!empty($params['isbn'])) {
            $params['isbn'] = implode(';', $params['isbn']);
        }
        return Http::get(
            $this->apiUrl . $endPoint,
            $params + ['api-key' => $this->apiKey]
        );
    }

    /**
     * @param BestSellerBooksFilterDto $filterDto
     *
     * @return array
     */
    private function prepareQueryParams(BestSellerBooksFilterDto $filterDto): array
    {
        return array_filter((array) $filterDto);
    }
}
