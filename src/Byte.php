<?php

declare(strict_types=1);

namespace VTikunov\Chains;

class Byte
{
    public static function maxOnesAfterRemoveItem(int ...$bytes): int
    {
        $previousSequencePartLength = 0;
        $currentSequencePartLength = 0;
        $maxSequenceLength = 0;
        $fullSequenceLength = count($bytes);

        foreach ($bytes as $index => $byte) {
            static::assertValidByte($byte);

            if (1 === $byte) {
                $currentSequencePartLength++;

                if ($index + 1 < $fullSequenceLength) {
                    continue;
                }
            }

            $currentSequenceLength = $previousSequencePartLength + $currentSequencePartLength;

            if ($currentSequenceLength > $maxSequenceLength) {
                $maxSequenceLength = $currentSequenceLength;
            }

            $previousSequencePartLength = $currentSequencePartLength;
            $currentSequencePartLength = 0;
        }

        if (0 < $fullSequenceLength && $maxSequenceLength === $fullSequenceLength) {
            $maxSequenceLength--;
        }

        return $maxSequenceLength;
    }

    protected static function assertValidByte(int $byte): void
    {
        if (0 !== $byte && 1 !== $byte) {
            throw new \RuntimeException("Неверное значение байта - $byte. Должен быть 0 или 1.");
        }
    }
}
