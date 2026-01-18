<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Grammar\Gender;
use NumberToWords\Language\Bulgarian\BulgarianDictionary;
use NumberToWords\Language\Bulgarian\BulgarianExponentInflector;
use NumberToWords\Language\Bulgarian\BulgarianNounGenderInflector;
use NumberToWords\Language\Bulgarian\BulgarianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class BulgarianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new BulgarianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $nounGenderInflector = new BulgarianNounGenderInflector();
        $tripletTransformer = (new BulgarianTripletTransformer($dictionary))
            ->setGrammaticalGender(Gender::GENDER_NEUTER);
        $exponentInflector = new BulgarianExponentInflector($nounGenderInflector);

        if ($number === 0) {
            return $dictionary->getZero();
        }

        $isNegative = $number < 0;
        $number = abs($number);

        $triplets = $numberToTripletsConverter->convertToTriplets($number);
        $allTripletsWithPowers = [];
        foreach ($triplets as $i => $triplet) {
            $power = count($triplets) - $i - 1;
            $allTripletsWithPowers[$power] = $triplet;
        }

        $nonZeroIndexes = array_keys(array_filter($triplets, fn($t) => $t > 0));
        $lastNonZeroIndex = end($nonZeroIndexes);

        $words = [];

        foreach ($triplets as $i => $triplet) {
            if ($triplet === 0) {
                continue;
            }

            $power = count($triplets) - $i - 1;

            $tripletWords = $tripletTransformer->transformToWords($triplet, $power, $allTripletsWithPowers);
            $exponent = $exponentInflector->inflectExponent($triplet, $power);

            $chunkParts = [];
            if ($tripletWords !== null && $tripletWords !== '') {
                $chunkParts[] = $tripletWords;
            }
            if ($exponent !== '') {
                $chunkParts[] = $exponent;
            }

            $chunk = implode($dictionary->getSeparator(), $chunkParts);

            $isLastNonZero = ($i === $lastNonZeroIndex);
            if ($isLastNonZero && !empty($words) && $triplet < 100) {
                $chunk = BulgarianDictionary::GRAMMATICAL_CONJUNCTION_AND . $dictionary->getSeparator() . $chunk;
            }

            $words[] = $chunk;
        }

        $result = implode($dictionary->getSeparator(), $words);

        if ($isNegative) {
            $result = $dictionary->getMinus() . $dictionary->getSeparator() . $result;
        }

        return $result;
    }
}
