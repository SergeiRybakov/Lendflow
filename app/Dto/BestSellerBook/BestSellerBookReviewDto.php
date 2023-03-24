<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBookReviewDto extends BasicDto
{
    public function __construct(
        public readonly ?string $bookReviewLink,
        public readonly ?string $firstChapterLink,
        public readonly ?string $sundayReviewLink,
        public readonly ?string $articleChapterLink
    ) {
    }
}
