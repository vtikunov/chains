<?php

declare(strict_types=1);

namespace VTikunov\test\Chains;

use VTikunov\Chains\Byte;
use PHPUnit\Framework\TestCase;

class ByteTest extends TestCase
{
    /**
     * @param int[] $bytes
     * @param int   $expectedResult
     *
     * @dataProvider longestSequenceOf1AfterDeletingAnyElementDataProvider
     */
    public function test_It_can_find_the_longest_sequence_of_1_after_deleting_any_element(
        array $bytes,
        int $expectedResult
    ): void {
        self::assertEquals($expectedResult, Byte::maxOnesAfterRemoveItem(...$bytes));
    }

    /**
     * @return \Iterator<array<int, mixed>>
     */
    public function longestSequenceOf1AfterDeletingAnyElementDataProvider(): \Iterator
    {
        yield [
            [0, 0],
            0,
        ];
        yield [
            [0, 1],
            1,
        ];
        yield [
            [1, 0],
            1,
        ];
        yield [
            [1, 1],
            1,
        ];
        yield [
            [1, 1, 0, 1, 1],
            4,
        ];
        yield [
            [1, 1, 0, 1, 1, 0, 1, 1, 1],
            5,
        ];
        yield [
            [1, 1, 0, 1, 1, 0, 1, 1, 1, 0],
            5,
        ];
    }

    /**
     * @param int[]                          $bytes
     * @param string                         $expectedException
     * @param string                         $expectedExceptionMessage
     *
     * @psalm-param class-string<\Throwable> $expectedException
     * @dataProvider illegalBytesExceptionDataProvider
     */
    public function test_It_throws_exception_for_illegal_bytes(
        array $bytes,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        Byte::maxOnesAfterRemoveItem(...$bytes);
    }

    /**
     * @return \Iterator<array<int, mixed>>
     */
    public function illegalBytesExceptionDataProvider(): \Iterator
    {
        yield [
            [0, $illegalByte = -1],
            \RuntimeException::class,
            "Неверное значение байта - $illegalByte. Должен быть 0 или 1.",
        ];
        yield [
            [0, 1, 0, 1, $illegalByte = 3, 1, 1, 0, 4],
            \RuntimeException::class,
            "Неверное значение байта - $illegalByte. Должен быть 0 или 1.",
        ];
        yield [
            [$illegalByte = 100, 1, 1, 0, 1],
            \RuntimeException::class,
            "Неверное значение байта - $illegalByte. Должен быть 0 или 1.",
        ];
    }
}
