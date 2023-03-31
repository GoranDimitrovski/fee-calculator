<?php

namespace Lendable\Interview\Interpolation\Tests\Service;

use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\Service\BreakpointDataProvider;
use Lendable\Interview\Interpolation\Service\FeeCalculatorIService;
use PHPUnit\Framework\TestCase;

class FeeCalculatorTest extends TestCase
{
    /**
     * @dataProvider nominalBreakpointDataProvider
     * @dataProvider customBreakpointsDataProvider
     */
    public function testCalculateFee(int $term, float $amount, float $expectedFee): void
    {
        $breakPointDataProvider = new BreakpointDataProvider(BreakpointDataProvider::FILE_PATH);
        $calculator = new FeeCalculatorIService($breakPointDataProvider);
        $application = new LoanApplication($term, $amount);
        $fee = $calculator->calculate($application);

        static::assertEquals($expectedFee, $fee);
    }

    public static function nominalBreakpointDataProvider(): array
    {
        return [
            [12, 1000, 50.0],
            [12, 2000, 90.0],
            [12, 3000, 90.0],
            [12, 4000, 115.0],
            [12, 5000, 100.0],
            [12, 6000, 120.0],
            [12, 7000, 140.0],
            [12, 8000, 160.0],
            [12, 9000, 180.0],
            [12, 10000, 200.0],
            [12, 11000, 220.0],
            [12, 12000, 240.0],
            [12, 13000, 260.0],
            [12, 14000, 280.0],
            [12, 15000, 300.0],
            [12, 16000, 320.0],
            [12, 17000, 340.0],
            [12, 18000, 360.0],
            [12, 19000, 380.0],
            [12, 20000, 400.0],
            [24, 1000, 70.0],
            [24, 2000, 100.0],
            [24, 3000, 120.0],
            [24, 4000, 160.0],
            [24, 5000, 200.0],
            [24, 6000, 240.0],
            [24, 7000, 280.0],
            [24, 8000, 320.0],
            [24, 9000, 360.0],
            [24, 10000, 400.0],
            [24, 11000, 440.0],
            [24, 12000, 480.0],
            [24, 13000, 520.0],
            [24, 14000, 560.0],
            [24, 15000, 600.0],
            [24, 16000, 640.0],
            [24, 17000, 680.0],
            [24, 18000, 720.0],
            [24, 19000, 760.0],
            [24, 20000, 800.0],
        ];
    }

    public static function customBreakpointsDataProvider(): array
    {
        return [
            [12, 1222.33, 62.67],
            [12, 1333.34, 66.66],
            [12, 1535.21, 74.79],
            [12, 1541.77, 73.23],
            [12, 1666.31, 78.69],
            [12, 1312.66, 67.34],
            [12, 1846.33, 88.67],
            [12, 1665.32, 79.68],
            [12, 1009.22, 50.78],
            [12, 1777.99, 82.01],
            [12, 1789.13, 85.87],
            [12, 1412.45, 67.55],
            [12, 1944.34, 90.66],
            [24, 1957.46, 102.54],
            [24, 1990.58, 104.42],
            [24, 4100.69, 164.31],
            [24, 4500.75, 184.25],
            [24, 4943.84, 201.16],
            [24, 15347.96, 617.04],
            [24, 1444.10, 85.9],
            [24, 1433.11, 86.89],
            [24, 1660.12, 89.88],
            [24, 12345.13, 494.87],
            [24, 12345.14, 494.86],
            [24, 14343.99, 576.01],
        ];
    }
}