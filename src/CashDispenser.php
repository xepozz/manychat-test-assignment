<?php

declare(strict_types=1);

namespace App;

class CashDispenser
{
    public function __construct(private readonly array $banknotes)
    {
    }

    public function calculate(int $sum): array
    {
        $moneyLeft = $sum;
        $banknotes = $this->banknotes;

        return $this->calculateInner($banknotes, $moneyLeft);
    }

    private function calculateInner(array $banknotes, int $moneyLeft): array
    {
        $banknotes = array_filter($banknotes, fn ($count) => $count > 0);
        $banknotesOriginal = $banknotes;
        $moneyLeftOriginal = $moneyLeft;
        $output = [];
        ksort($banknotes, SORT_STRING);

        foreach ($banknotes as $banknote => $count) {
            $banknotesToGive = min((int) floor($moneyLeft / $banknote), $count);
            if ($banknotesToGive === 0) {
                continue;
            }
            $banknotes[$banknote] -= $banknotesToGive;
            $output[$banknote] = $banknotesToGive;

            $moneyLeft -= $banknotesToGive * $banknote;
        }

        if ($moneyLeft > 0) {
            $banknotes = $banknotesOriginal;
            foreach ($output as $banknote => $_) {
                $banknotes[$banknote]--;
                break;
            }
            return $this->calculateInner($banknotes, $moneyLeftOriginal);
        }

        return $output;
    }

}