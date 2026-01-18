<?php

namespace NumberToWords\Language\Romanian;

use NumberToWords\Grammar\Gender;
use NumberToWords\Language\GrammaticalGenderAwareInterface;
use NumberToWords\Language\GrammaticalGenderAwareTrait;
use NumberToWords\Language\PowerAwareTripletTransformer;

class RomanianTripletTransformer implements PowerAwareTripletTransformer, GrammaticalGenderAwareInterface
{
    use GrammaticalGenderAwareTrait;

    private Dictionary $dictionary;
    private bool $useArticleForOne = false;

    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function setUseArticleForOne(bool $useArticleForOne): self
    {
        $this->useArticleForOne = $useArticleForOne;

        return $this;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $tensAndUnits = $number % 100;

        $parts = [];

        if ($hundreds > 0) {
            $parts[] = $this->buildHundreds($hundreds);
        }

        if ($tensAndUnits > 0) {
            $parts = array_merge($parts, $this->buildTensAndUnits($units, $tens, $tensAndUnits, $power, $allTriplets));
        }

        return implode($this->dictionary->getWordSeparator(), $parts);
    }

    private function buildHundreds(int $hundreds): string
    {
        $hundredNoun = $this->dictionary->getExponentByPower(2);

        $words = [];
        $words[] = $this->dictionary->getNumberInflectionForGender(
            Dictionary::$numbers[$hundreds],
            Gender::GENDER_FEMININE,
            true
        );

        if (is_array($hundredNoun)) {
            $words[] = $this->dictionary->getNounDeclensionForNumber($hundreds, $hundredNoun);
        }

        return implode($this->dictionary->getWordSeparator(), $words);
    }

    private function buildTensAndUnits(int $units, int $tens, int $tensAndUnits, int $power, array $allTriplets): array
    {
        $gender = $this->getGenderForPower($power);
        $words = [];

        $forceArticle = $this->shouldUseArticleForOne($tensAndUnits, $power, $allTriplets);
        $asNoun = !$forceArticle;

        if (array_key_exists($tensAndUnits, Dictionary::$numbers)) {
            $words[] = $this->dictionary->getNumberInflectionForGender(Dictionary::$numbers[$tensAndUnits], $gender, $asNoun);

            return $words;
        }

        if ($tens > 0) {
            $words[] = $this->dictionary->getCorrespondingTen($tens * 10);
        }

        if ($units > 0) {
            if ($tens > 0) {
                $words[] = $this->dictionary->getAnd();
            }

            $words[] = $this->dictionary->getNumberInflectionForGender(Dictionary::$numbers[$units], $gender, $asNoun);
        }

        return $words;
    }

    private function getGenderForPower(int $power): int
    {
        if ($power === 0) {
            return $this->getGrammaticalGender();
        }

        return $this->dictionary->getGenderForPower($power);
    }

    private function shouldUseArticleForOne(int $number, int $power, array $allTriplets): bool
    {
        if (!$this->useArticleForOne) {
            return false;
        }

        if ($number !== 1) {
            return false;
        }

        if ($power !== 0) {
            return false;
        }

        $nonZeroTriplets = array_filter($allTriplets, fn($triplet) => $triplet > 0);

        return count($nonZeroTriplets) === 1;
    }
}
