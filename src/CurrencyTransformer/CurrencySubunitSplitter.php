<?php

namespace NumberToWords\CurrencyTransformer;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exception\UnknownCurrencyException;

trait CurrencySubunitSplitter
{
    /**
     * Split amount into decimal and fractional parts based on currency subunit.
     *
     * @param int    $amount   The total amount in subunits
     * @param string $currency The currency code (e.g., 'USD', 'JPY')
     *
     * @return array{0: int, 1: int} Array with decimal part and fractional part
     */
    private function splitAmount(int $amount, string $currency): array
    {
        $currencies = new ISOCurrencies();
        $currencyObject = new Currency($currency);

        try {
            $subunit = $currencies->subunitFor($currencyObject);
        } catch (UnknownCurrencyException $e) {
            // Fallback to 2 decimal places for unknown currencies
            $subunit = 2;
        }

        $divisor = (int) (10 ** $subunit);

        $decimal = (int) ($amount / $divisor);
        $fraction = abs($amount % $divisor);

        return [$decimal, $fraction];
    }
}
