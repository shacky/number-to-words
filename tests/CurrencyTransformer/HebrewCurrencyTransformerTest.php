<?php

namespace NumberToWords\CurrencyTransformer;

class HebrewCurrencyTransformerTest extends CurrencyTransformerTest
{
    protected function setUp(): void
    {
        $this->currencyTransformer = new HebrewCurrencyTransformer();
    }

    public function providerItConvertsMoneyAmountToWords(): array
    {
        return [
            [100, 'USD', 'אחד דולר'],
            [125, 'USD', 'אחד דולר ועשרים וחמש סנט'],
            [10100, 'USD', 'מאה ואחד דולר'],
            [-12345, 'USD', 'מינוס מאה עשרים ושלוש דולר וארבעים וחמש סנט'],
            [100, 'ILS', 'אחד ש"ח'],
            [101, 'ILS', 'אחד ש"ח ואחד אגו\''],
            [12345, 'ILS', 'מאה עשרים ושלוש ש"ח וארבעים וחמש אגו\''],
            [100, 'EUR', 'אחד אירו'],
            [10100, 'EUR', 'מאה ואחד אירוs'],
        ];
    }
}
