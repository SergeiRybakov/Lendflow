<?php

namespace Tests\Unit;

use App\Dto\BestSellingBook\BestSellerBookDto;
use App\Exceptions\InvalidDtoInputDataException;
use App\Hydrators\Common\Hydrator;
use PHPUnit\Framework\TestCase;

class HydratorTest extends TestCase
{
    private Hydrator $hydrator;
    private array $dtoBlueprint;

    public function setUp(): void
    {
        parent::setUp();
        $this->hydrator = app()->make(Hydrator::class);
        $this->dtoBlueprint = [
            'title' => 'title',
            'description' => 'description',
            'contributor' => 'contributor',
            'author' => 'author',
            'contributor_note' => 'contributorNote',
            'price' => 2,
            'age_group' => 'ageGroup',
            'publisher' => 'publisher',
            'ranks_history' => [
                [
                    'primaryIsbn10' => '1111111111',
                    'primaryIsbn13' => '1111111111111',
                    'rank' => 1,
                    'list_name' => 'listName',
                    'display_name' => 'display_name',
                    'published_date' => 'published_date',
                    'bestsellers_date' => 'bestsellers_date',
                    'weeksOnList' => 1,
                    'rankLastWeek' => 1,
                    'asterisk' => 1,
                    'dagger' => 1
                ],
                [
                    'primaryIsbn10' => '1111111112',
                    'primaryIsbn13' => '1111111111112',
                    'rank' => 2,
                    'list_name' => 'listName2',
                    'display_name' => 'display_name2',
                    'published_date' => 'published_date2',
                    'bestsellers_date' => 'bestsellers_date2',
                    'weeksOnList' => 1,
                    'rankLastWeek' => 1,
                    'asterisk' => 1,
                    'dagger' => 1
                ],
            ],
            'isbns' => [
                ['isbn10' => '1111111111', 'isbn13' =>  '1111111111111'],
                ['isbn10' => '2222222222', 'isbn13' =>  '2222222222222'],
                ['isbn10' => '3333333333', 'isbn13' =>  '3333333333333']
            ],
            'reviews' => [
                [
                    'bookReviewLink' => 'bookReviewLink',
                    'firstChapterLink' => 'firstChapterLink',
                    'sundayReviewLink' => 'sundayReviewLink',
                    'articleChapterLink' => 'articleChapterLink'
                ],
                [
                    'bookReviewLink' => 'bookReviewLink',
                    'firstChapterLink' => 'firstChapterLink',
                    'sundayReviewLink' => 'sundayReviewLink',
                    'articleChapterLink' => 'articleChapterLink'
                ]
            ]
        ];
    }

    public function test_hydrator(): void
    {
        $object = $this->hydrator->hydrate(
            BestSellerBookDto::class,
            $this->dtoBlueprint,
            true
        );
        $this->assertTrue(get_class($object) === BestSellerBookDto::class);
    }

    public function test_hydrator_exception(): void
    {
        $invalidDto = $this->dtoBlueprint;
        unset($invalidDto['title']);
        $gotAnException = false;
        try {
            $this->hydrator->hydrate(
                BestSellerBookDto::class,
                $invalidDto,
                true
            );
        } catch (InvalidDtoInputDataException $e) {
            $this->assertTrue(true);
            $gotAnException = true;
        }

        if (!$gotAnException) {
            $this->fail();
        }
    }
}
