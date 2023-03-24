<?php

namespace App\Services;

use App\Dto\BestSellingBook\BestSellerBookDto;
use App\Dto\BestSellingBook\BestSellerBookFilterDto;
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
     * Get the list of bestsellers books front NYT API with requested filters applied
     *
     * Documentation for the NYT API method:
     * https://developer.nytimes.com/docs/books-product/1/routes/lists.json/get
     *
     * @param BestSellerBookFilterDto $filterDto
     *
     * @return array|null
     */
    public function getBestSellers(BestSellerBookFilterDto $filterDto): ?array
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
                $result[] = $this->hydrator->hydrate(BestSellerBookDto::class, $book, true);
            }
        }

        return $result;
    }

    /**
     * Make API request to NYT
     *
     * @param string $endPoint
     * @param BestSellerBookFilterDto $filterDto
     *
     * @return PromiseInterface|Response
     */
    private function apiRequest(string $endPoint, BestSellerBookFilterDto $filterDto): PromiseInterface|Response
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
     * Remove all NULL and empty values from future Query parameters
     *
     * @param BestSellerBookFilterDto $filterDto
     *
     * @return array
     */
    private function prepareQueryParams(BestSellerBookFilterDto $filterDto): array
    {
        return array_filter((array) $filterDto);
    }
}
