<?php

namespace NumberToWords\Language\Macedonian;

use NumberToWords\Language\GrammaticalGenderAwareInterface;
use NumberToWords\Language\GrammaticalGenderAwareTrait;
use NumberToWords\Language\PowerAwareTripletTransformer;

class MacedonianTripletTransformer implements PowerAwareTripletTransformer, GrammaticalGenderAwareInterface
{
    use GrammaticalGenderAwareTrait;

    protected MacedonianDictionary $dictionary;
    private ?int $previousPower = null;
    private bool $lastAndPlaced = false;

    public function __construct(MacedonianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Determine if this is the last non-zero triplet
        $isLastNonZeroTriplet = $this->isLastNonZeroTriplet($power, $allTriplets);
        
        // Check if there are higher power triplets (to know if we need "и" prefix)
        $hasHigherPowerTriplets = false;
        foreach ($allTriplets as $p => $value) {
            if ($p > $power && $value > 0) {
                $hasHigherPowerTriplets = true;
                break;
            }
        }

        // Process hundreds
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds * 100);
        }

        // Process tens
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units + 10);
        } else {
            if ($tens > 0) {
                $words[] = $this->dictionary->getCorrespondingTen($tens * 10);
            }
        }

        // Process units
        if ($units > 0 && $tens !== 1) {
            // For 1000 (thousand), omit "една" (one)
            if ($power === 1 && $units === 1 && $hundreds === 0 && $tens === 0) {
                return null;
            }

            $words[] = $this->dictionary->getCorrespondingUnitForGrammaticalGender(
                $units,
                $power === 0
                    ? $this->getGrammaticalGender()
                    : MacedonianDictionary::ENUMERATIONS
                        [MacedonianDictionary::ENUMERATION_BY_POWERS_OF_A_THOUSAND]
                        [$power]
                        [GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER]
            );
        }

        // Handle conjunctions "и" (and)
        $result = $this->addConjunctions($words, $hundreds, $tens, $units, $isLastNonZeroTriplet, $hasHigherPowerTriplets);

        $this->previousPower = $power;

        return $result;
    }

    private function isLastNonZeroTriplet(int $currentPower, array $allTriplets): bool
    {
        for ($p = $currentPower - 1; $p >= 0; $p--) {
            if (isset($allTriplets[$p]) && $allTriplets[$p] > 0) {
                return false;
            }
        }
        return true;
    }

    private function addConjunctions(array $words, int $hundreds, int $tens, int $units, bool $isLast, bool $hasHigherPowerTriplets): string
    {
        if (count($words) === 0) {
            return '';
        }

        $result = [];
        
        // Within triplet: add "и" before the last word if we have multiple words
        // Examples: "сто и еден" (101), "дваесет и три" (23), "триста педесет и шест" (356)
        if (count($words) > 1) {
            for ($i = 0; $i < count($words) - 1; $i++) {
                $result[] = $words[$i];
            }
            $result[] = MacedonianDictionary::GRAMMATICAL_CONJUNCTION_AND;
            $result[] = $words[count($words) - 1];
        } else {
            $result = $words;
        }

        $resultStr = implode(' ', $result);

        // Between triplets: add "и" before this triplet if:
        // - This is the last non-zero triplet
        // - There are higher power triplets (multi-triplet number)
        // - AND either: no hundreds (e.g., "илјада и еден" for 1001)
        //            OR only one word (e.g., "илјади и триста" for 565300)
        if ($isLast && !$this->lastAndPlaced && $hasHigherPowerTriplets) {
            if ($hundreds === 0 || count($words) === 1) {
                $this->lastAndPlaced = true;
                $resultStr = MacedonianDictionary::GRAMMATICAL_CONJUNCTION_AND . ' ' . $resultStr;
            }
        }

        return $resultStr;
    }
}
