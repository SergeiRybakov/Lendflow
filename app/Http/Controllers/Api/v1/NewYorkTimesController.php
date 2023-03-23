<?php

namespace App\Http\Controllers\Api\v1;

use App\Dto\BestSellingBook\BestSellerBooksDto;
use App\Dto\BestSellingBook\BestSellerBooksFilterDto;
use App\Http\Controllers\Controller;
use App\Repositories\NewYorkTimes\NewYorkTimesBookRepositoryInterface;
use App\Rules\NytOffset;
use HttpResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewYorkTimesController extends Controller
{

    public function __construct(
        protected NewYorkTimesBookRepositoryInterface $repository
    ) {
    }

    /**
     * Retrieve records from NYT API https://api.nytimes.com/svc/books/v3/lists.json
     *
     * @param Request $request
     *
     * @return array|BestSellerBooksDto|HttpResponse|null|BestSellerBooksDto
     */
    public function actionGet(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'author' => ['string', 'max:255'],
                'isbn' => ['array'],
                'isbn.*' => ['string', 'min:10', 'max:13'],
                'title' => ['string', 'max:255'],
                'offset' => ['string', new NytOffset()]
            ]
        );

        if ($validator->fails()) {
            return new Response($validator->errors(), 422, []);
        }
        $data = $validator->valid();
        $filterDto = new BestSellerBooksFilterDto(
            $data['author'] ?? null,
            $data['isbn'] ?? null,
            $data['title'] ?? null,
            $data['offset'] ?? null
        );

        return $this->repository->getBestSellerBooksByFilter($filterDto);
    }
}
