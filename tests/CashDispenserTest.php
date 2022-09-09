<?php

declare(strict_types=1);

namespace App\Tests;

use App\CashDispenser;

class CashDispenserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider mainProvider
     */
    public function testMain(array $banknotes, int $sum, array $expectedResult)
    {
        $dispenser = new CashDispenser($banknotes);
        $actualResult = $dispenser->calculate($sum);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @dataProvider failureProvider
     */
    public function testFailure(array $banknotes, int $sum)
    {
        $dispenser = new CashDispenser($banknotes);

        $this->expectException(\LogicException::class);
        $dispenser->calculate($sum);
    }

    public function mainProvider(): array
    {
        return [
            [
                ['50' => 3, '100' => 4],
                100,
                [100 => 1],
            ],
            [
                ['50' => 3, '100' => 4],
                150,
                [100 => 1, 50 => 1],
            ],
            [
                ['50' => 3, '100' => 4],
                200,
                [100 => 2],
            ],
            [
                ['50' => 3, '100' => 4],
                250,
                [100 => 2, 50 => 1],
            ],
            [
                ['50' => 3, '100' => 1],
                250,
                [100 => 1, 50 => 3],
            ],
            [
                ['30' => 4],
                120,
                [30 => 4],
            ],
            [
                ['30' => 4, '100' => 1],
                120,
                [30 => 4],
            ],
            [
                ['30' => 4, '50' => 1000000000, '100' => 1000000000],
                120,
                [30 => 4],
            ],
            [
                ['10' => 1000000000000],
                1000000000000,
                [10 => 100000000000],
            ],
        ];
    }

    public function failureProvider(): array
    {
        return [
            [
                ['100' => 1],
                0,
            ],
            [
                [],
                50,
            ],
            [
                ['100' => 1],
                200,
            ],
            [
                ['30' => 3, '50' => 1, '100' => 1],
                120,
            ],
        ];
    }
}