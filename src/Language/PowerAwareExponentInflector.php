<?php

namespace NumberToWords\Language;

/**
 * Extended ExponentInflector interface that provides context about all powers in the number.
 * This allows inflectors to make decisions based on whether there are higher powers present.
 * 
 * For example, in Spanish long scale:
 * - 1,000,000,000 alone should be "mil millones" (thousand millions)
 * - But in 2,935,000,000,000 the 935 at power 3 should just use "mil" (thousand)
 */
interface PowerAwareExponentInflector extends ExponentInflector
{
    /**
     * Inflect the exponent name based on the number and power, with awareness of the maximum power.
     *
     * @param int $number The triplet value (0-999)
     * @param int $power The power of the triplet (0 for units, 1 for thousands, 2 for millions, etc.)
     * @param int $maxPower The highest power present in the full number being converted
     * @param int $nonZeroTripletCount The total count of non-zero triplets in the number
     * @return string The inflected exponent name
     */
    public function inflectExponentWithContext(int $number, int $power, int $maxPower, int $nonZeroTripletCount): string;
}
