<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBookFilterDto extends BasicDto
{
    public function __construct(
        public readonly ?string $author,
        public readonly ?array $isbn,
        public readonly ?string $title,
        public readonly ?int $offset,
    ) {
    }
}
