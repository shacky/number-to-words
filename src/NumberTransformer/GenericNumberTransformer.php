<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Dictionary;
use NumberToWords\Language\ExponentGetter;
use NumberToWords\Language\ExponentInflector;
use NumberToWords\Language\PowerAwareExponentInflector;
use NumberToWords\Language\PowerAwareTripletTransformer;
use NumberToWords\Language\TripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class GenericNumberTransformer implements NumberTransformer
{
    private Dictionary $dictionary;
    private ?TripletTransformer $tripletTransformer = null;
    private ?PowerAwareTripletTransformer $powerAwareTripletTransformer = null;
    private NumberToTripletsConverter $numberToTripletsConverter;
    private ?ExponentInflector $exponentInflector = null;
    private ?ExponentGetter $exponentGetter = null;
    private ?string $wordsSeparator = null;
    private ?string $exponentSeparator = null;

    public function toWords(int $number): string
    {
        if ($number === 0) {
            return $this->dictionary->getZero();
        }

        $words = [];
        $minus = '';

        if ($number < 0) {
            $minus = $this->dictionary->getMinus();
            $number *= -1;
        }

        if ($this->tripletTransformer !== null || $this->powerAwareTripletTransformer !== null) {
            $words = array_merge($words, $this->getWordsBySplittingIntoTriplets($number));
        }

        return trim(sprintf('%s %s', $minus, implode($this->wordsSeparator, $words)));
    }

    private function getWordsBySplittingIntoTriplets(int $number): array
    {
        $words = [];
        $triplets = $this->numberToTripletsConverter->convertToTriplets($number);
        $maxPower = count($triplets) - 1;
        $nonZeroTripletCount = count(array_filter($triplets, fn($t) => $t > 0));

        // Build an associative array of all triplets indexed by power (for context-aware transformers)
        $allTripletsWithPowers = [];
        foreach ($triplets as $i => $triplet) {
            $power = count($triplets) - $i - 1;
            $allTripletsWithPowers[$power] = $triplet;
        }

        foreach ($triplets as $i => $triplet) {
            if ($triplet > 0) {
                $power = count($triplets) - $i - 1;

                if ($this->tripletTransformer !== null) {
                    $words[] = $this->tripletTransformer->transformToWords($triplet);
                }

                if ($this->powerAwareTripletTransformer !== null) {
                    // Pass allTriplets context to PowerAwareTripletTransformer
                    $tripletTransformResult = $this->powerAwareTripletTransformer->transformToWords(
                        $triplet,
                        $power,
                        $allTripletsWithPowers
                    );

                    if ($tripletTransformResult !== null) {
                        $words[] = $tripletTransformResult;
                    }
                }

                if ($this->exponentInflector !== null) {
                    // Use PowerAwareExponentInflector if available, otherwise fall back to regular
                    if ($this->exponentInflector instanceof PowerAwareExponentInflector) {
                        $words[] = $this->exponentInflector->inflectExponentWithContext($triplet, $power, $maxPower, $nonZeroTripletCount);
                    } else {
                        $words[] = $this->exponentInflector->inflectExponent($triplet, $power);
                    }
                }

                if ($this->exponentGetter !== null) {
                    $words[] = $this->exponentGetter->getExponent($power);
                }
            }
        }

        if ($this->exponentSeparator !== null && count($words) > 2) {
            for ($i = 2; $i <= count($words) - 2; $i += 2) {
                array_splice($words, $i++, 0, $this->exponentSeparator);
            }
        }

        return $words;
    }

    public function setDictionary(Dictionary $dictionary): void
    {
        $this->dictionary = $dictionary;
    }

    public function setTripletTransformer(TripletTransformer $tripletTransformer): void
    {
        $this->tripletTransformer = $tripletTransformer;
        $this->powerAwareTripletTransformer = null;
    }

    public function setPowerAwareTripletTransformer(PowerAwareTripletTransformer $powerAwareTripletTransformer): void
    {
        $this->powerAwareTripletTransformer = $powerAwareTripletTransformer;
        $this->tripletTransformer = null;
    }

    public function setWordsSeparator(string $wordsSeparator): void
    {
        $this->wordsSeparator = $wordsSeparator;
    }

    public function setNumberToTripletsConverter(NumberToTripletsConverter $numberToTripletsConverter): void
    {
        $this->numberToTripletsConverter = $numberToTripletsConverter;
    }

    public function setExponentInflector(ExponentInflector $exponentInflector): void
    {
        $this->exponentInflector = $exponentInflector;
        $this->exponentGetter = null;
    }

    public function setExponentGetter(ExponentGetter $exponentGetter): void
    {
        $this->exponentGetter = $exponentGetter;
        $this->exponentInflector = null;
    }

    public function setExponentsSeparator(string $exponentSeparator): void
    {
        $this->exponentSeparator = $exponentSeparator;
    }
}
