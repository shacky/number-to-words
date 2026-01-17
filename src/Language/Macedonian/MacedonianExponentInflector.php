<?php

namespace NumberToWords\Language\Macedonian;

use NumberToWords\Grammar\Form;
use NumberToWords\Grammar\Gender;
use NumberToWords\Language\ExponentInflector;
use NumberToWords\Language\GrammaticalGenderAwareInterface;

class MacedonianExponentInflector implements ExponentInflector
{
    private MacedonianDictionary $dictionary;

    public function __construct(MacedonianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0) {
            return '';
        }

        $exponents = MacedonianDictionary::ENUMERATIONS[MacedonianDictionary::ENUMERATION_BY_POWERS_OF_A_THOUSAND];
        
        if (!isset($exponents[$power])) {
            return '';
        }

        $exponent = $exponents[$power];
        
        // Determine singular vs plural
        // In Macedonian, use singular for exactly 1, plural otherwise
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        
        // Use singular form if:
        // - number is exactly 1
        // - OR number ends in 1 but NOT 11
        $useSingular = ($number === 1) || ($units === 1 && $tens !== 1 && $number > 1);
        
        $form = $useSingular ? Form::SINGULAR : Form::PLURAL;
        
        return $exponent[$form];
    }
}
