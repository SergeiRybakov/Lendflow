<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBookDto extends BasicDto
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
         * @var BestSellerBookIsbnDto[]
         */
        public readonly ?array $isbns,
        /**
         * @var BestSellerBookRankHistoryDto[]
         */
        public readonly ?array $ranksHistory,
        /**
         * @var BestSellerBookReviewDto[]
         */
        public readonly ?array $reviews
    ) {
    }
}
