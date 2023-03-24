<?php

namespace Tests\Unit;

use App\Dto\BestSellingBook\BestSellerBookDto;
use App\Dto\BestSellingBook\BestSellerBookIsbnDto;
use App\Dto\BestSellingBook\BestSellerBookRankHistoryDto;
use App\Dto\BestSellingBook\BestSellerBookReviewDto;
use PHPUnit\Framework\TestCase;

class BestSellerBooksDtoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_dto(): void
    {
        $data = [
            'title' => 'title',
            'description' => 'description',
            'contributor' => 'contributor',
            'author' => 'author',
            'contributorNote' => 'contributorNote',
            'price' => 5,
            'ageGroup' => 'ageGroup',
            'publisher' => 'publisher',
            'isbns' => [
                new BestSellerBookIsbnDto("1111111111", "1111111111111"),
                new BestSellerBookIsbnDto("2222222222", "2222222222222"),
                new BestSellerBookIsbnDto("3333333333", "3333333333333"),
            ],
            'ranksHistory' => [
                new BestSellerBookRankHistoryDto(
                    'primaryIsbn10',
                    'primaryIsbn13',
                    1,
                    'listName',
                    'displayName',
                    'publishedDate',
                    'bestsellersDate',
                    1,
                    1,
                    1,
                    1
                ),
                new BestSellerBookRankHistoryDto(
                    'primaryIsbn102',
                    'primaryIsbn132',
                    2,
                    'listName2',
                    'displayName2',
                    'publishedDate2',
                    'bestsellersDate2',
                    2,
                    2,
                    2,
                    2
                )
            ],
            'reviews' => [
                new BestSellerBookReviewDto(
                    'bookReviewLink',
                    'firstChapterLink',
                    'sundayReviewLink',
                    'articleChapterLink'
                ),
                new BestSellerBookReviewDto(
                    'bookReviewLink2',
                    'firstChapterLink2',
                    'sundayReviewLink2',
                    'articleChapterLink2'
                )
            ]
        ];
        $dto = new BestSellerBookDto(...$data);
        $this->assertEquals('title', $dto->title);
        $this->assertEquals('description', $dto->description);
        $this->assertEquals('contributor', $dto->contributor);
        $this->assertEquals('author', $dto->author);
        $this->assertEquals('contributorNote', $dto->contributorNote);
        $this->assertEquals(5, $dto->price);
        $this->assertEquals('ageGroup', $dto->ageGroup);
        $this->assertEquals('publisher', $dto->publisher);

        $this->assertTrue(get_class($dto->isbns[0]) === BestSellerBookIsbnDto::class);
        $this->assertTrue(get_class($dto->isbns[1]) === BestSellerBookIsbnDto::class);
        $this->assertEquals('1111111111', $dto->isbns[0]->isbn10);
        $this->assertEquals('2222222222', $dto->isbns[1]->isbn10);
        $this->assertEquals('3333333333', $dto->isbns[2]->isbn10);
        $this->assertEquals('1111111111111', $dto->isbns[0]->isbn13);
        $this->assertEquals('2222222222222', $dto->isbns[1]->isbn13);
        $this->assertEquals('3333333333333', $dto->isbns[2]->isbn13);

        $this->assertTrue(get_class($dto->ranksHistory[0]) === BestSellerBookRankHistoryDto::class);
        $this->assertEquals('primaryIsbn10', $dto->ranksHistory[0]->primaryIsbn10);
        $this->assertEquals('primaryIsbn13', $dto->ranksHistory[0]->primaryIsbn13);
        $this->assertEquals(1, $dto->ranksHistory[0]->rank);
        $this->assertEquals('listName', $dto->ranksHistory[0]->listName);
        $this->assertEquals('displayName', $dto->ranksHistory[0]->displayName);
        $this->assertEquals('bestsellersDate', $dto->ranksHistory[0]->bestsellersDate);
        $this->assertEquals(1, $dto->ranksHistory[0]->weeksOnList);
        $this->assertEquals(1, $dto->ranksHistory[0]->rankLastWeek);
        $this->assertEquals(1, $dto->ranksHistory[0]->asterisk);
        $this->assertEquals(1, $dto->ranksHistory[0]->dagger);

        $this->assertTrue(get_class($dto->ranksHistory[1]) === BestSellerBookRankHistoryDto::class);
        $this->assertEquals('primaryIsbn102', $dto->ranksHistory[1]->primaryIsbn10);
        $this->assertEquals('primaryIsbn132', $dto->ranksHistory[1]->primaryIsbn13);
        $this->assertEquals(2, $dto->ranksHistory[1]->rank);
        $this->assertEquals('listName2', $dto->ranksHistory[1]->listName);
        $this->assertEquals('displayName2', $dto->ranksHistory[1]->displayName);
        $this->assertEquals('bestsellersDate2', $dto->ranksHistory[1]->bestsellersDate);
        $this->assertEquals(2, $dto->ranksHistory[1]->weeksOnList);
        $this->assertEquals(2, $dto->ranksHistory[1]->rankLastWeek);
        $this->assertEquals(2, $dto->ranksHistory[1]->asterisk);
        $this->assertEquals(2, $dto->ranksHistory[1]->dagger);

        $this->assertTrue(get_class($dto->reviews[0]) === BestSellerBookReviewDto::class);
        $this->assertTrue(get_class($dto->reviews[1]) === BestSellerBookReviewDto::class);
        $this->assertEquals('bookReviewLink', $dto->reviews[0]->bookReviewLink);
        $this->assertEquals('firstChapterLink', $dto->reviews[0]->firstChapterLink);
        $this->assertEquals('sundayReviewLink', $dto->reviews[0]->sundayReviewLink);
        $this->assertEquals('articleChapterLink', $dto->reviews[0]->articleChapterLink);
        $this->assertEquals('bookReviewLink2', $dto->reviews[1]->bookReviewLink);
        $this->assertEquals('firstChapterLink2', $dto->reviews[1]->firstChapterLink);
        $this->assertEquals('sundayReviewLink2', $dto->reviews[1]->sundayReviewLink);
        $this->assertEquals('articleChapterLink2', $dto->reviews[1]->articleChapterLink);
    }
}
