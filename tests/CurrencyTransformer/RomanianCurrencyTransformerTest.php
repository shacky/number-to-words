<?php

namespace NumberToWords\CurrencyTransformer;

class RomanianCurrencyTransformerTest extends CurrencyTransformerTest
{
    protected function setUp(): void
    {
        $this->currencyTransformer = new RomanianCurrencyTransformer();
    }

    public function providerItConvertsMoneyAmountToWords(): array
    {
        return [
            [100, 'RON', 'un leu'],
            [200, 'RON', 'doi lei'],
            [140, 'RON', 'un leu și patruzeci de bani'],
            [145, 'RON', 'un leu și patruzeci și cinci de bani'],
            [200000, 'RON', 'două mii de lei'],
        ];
    }
}
