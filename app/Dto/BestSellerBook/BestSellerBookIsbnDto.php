<?php

namespace App\Dto\BestSellingBook;

use App\Dto\Common\BasicDto;

class BestSellerBookIsbnDto extends BasicDto
{
    public function __construct(
        public readonly ?string $isbn10 = null,
        public readonly ?string $isbn13 = null
    ) {
    }
}
