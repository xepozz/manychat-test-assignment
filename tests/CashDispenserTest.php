<?php

declare(strict_types=1);

namespace App\Tests;

use App\CashDispenser;

class CashDispenserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testMain(array $banknotes, int $sum, array $expectedResult)
    {
        $dispenser = new CashDispenser($banknotes);
        $actualResult = $dispenser->calculate($sum);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function dataProvider(): array
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
        ];
    }
}