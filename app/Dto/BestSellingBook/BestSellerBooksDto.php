<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBooksDto extends BasicDto
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $contributor,
        public readonly ?string $author,
        public readonly ?string $contributorNote,
        public readonly ?float $price,
        public readonly ?string $ageGroup,
        public readonly ?string $publisher,
        /**
         * @var BestSellerBooksIsbnDto[]
         */
        public readonly ?array $isbns,
        /**
         * @var BestSellerBooksRanksHistoryDto[]
         */
        public readonly ?array $ranksHistory,
        /**
         * @var BestSellerBooksReviewDto[]
         */
        public readonly ?array $reviews
    ) {
    }
}
