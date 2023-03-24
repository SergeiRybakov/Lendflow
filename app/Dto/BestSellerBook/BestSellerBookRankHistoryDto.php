<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBookRankHistoryDto extends BasicDto
{
    public function __construct(
        public readonly ?string $primaryIsbn10,
        public readonly ?string $primaryIsbn13,
        public readonly ?int $rank,
        public readonly ?string $listName,
        public readonly ?string $displayName,
        public readonly ?string $publishedDate,
        public readonly ?string $bestsellersDate,
        public readonly ?int $weeksOnList,
        public readonly ?int $rankLastWeek,
        public readonly ?int $asterisk,
        public readonly ?int $dagger
    ) {
    }
}
