<?php

namespace NumberToWords\Language\Macedonian;

use NumberToWords\Grammar\Form;
use NumberToWords\Grammar\Gender;
use NumberToWords\Language\Dictionary;
use NumberToWords\Language\GrammaticalGenderAwareInterface;

class MacedonianDictionary implements Dictionary
{
    public const LOCALE = 'mk_MK';
    public const LANGUAGE_NAME = 'Macedonian';
    public const LANGUAGE_NAME_NATIVE = 'Македонски';

    public const ENUMERATION_BY_VALUE = 'enumerationByValue';
    public const ENUMERATION_BY_POWERS_OF_A_THOUSAND = 'enumerationByPowersOfAThousand';

    public const ARITHMETIC_MINUS = 'минус';
    public const SEPARATOR = ' ';
    public const GRAMMATICAL_CONJUNCTION_AND = 'и';

    public const ENUMERATIONS = [
        self::ENUMERATION_BY_VALUE => [
            0 => 'нула',
            1 => [
                Gender::GENDER_MASCULINE => 'еден',
                Gender::GENDER_FEMININE => 'една',
                Gender::GENDER_NEUTER => 'едно',
                Gender::GENDER_ABSTRACT => 'еден',
            ],
            2 => [
                Gender::GENDER_MASCULINE => 'два',
                Gender::GENDER_FEMININE => 'две',
                Gender::GENDER_NEUTER => 'две',
                Gender::GENDER_ABSTRACT => 'два',
            ],
            3 => 'три',
            4 => 'четири',
            5 => 'пет',
            6 => 'шест',
            7 => 'седум',
            8 => 'осум',
            9 => 'девет',

            10 => 'десет',
            11 => 'единаесет',
            12 => 'дванаесет',
            13 => 'тринаесет',
            14 => 'четиринаесет',
            15 => 'петнаесет',
            16 => 'шеснаесет',
            17 => 'седумнаесет',
            18 => 'осумнаесет',
            19 => 'деветнаесет',

            20 => 'дваесет',
            30 => 'триесет',
            40 => 'четириесет',
            50 => 'педесет',
            60 => 'шеесет',
            70 => 'седумдесет',
            80 => 'осумдесет',
            90 => 'деведесет',

            100 => 'сто',
            200 => 'двесте',
            300 => 'триста',
            400 => 'четиристотини',
            500 => 'петстотини',
            600 => 'шестотини',
            700 => 'седумстотини',
            800 => 'осумстотини',
            900 => 'деветстотини',
        ],
        self::ENUMERATION_BY_POWERS_OF_A_THOUSAND => [
            1 => [
                Form::SINGULAR => 'илјада',
                Form::PLURAL => 'илјади',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_FEMININE,
            ],
            2 => [
                Form::SINGULAR => 'милион',
                Form::PLURAL => 'милиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            3 => [
                Form::SINGULAR => 'милјарда',
                Form::PLURAL => 'милјарди',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_FEMININE,
            ],
            4 => [
                Form::SINGULAR => 'трилион',
                Form::PLURAL => 'трилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            5 => [
                Form::SINGULAR => 'квадрилион',
                Form::PLURAL => 'квадрилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            6 => [
                Form::SINGULAR => 'квинтилион',
                Form::PLURAL => 'квинтилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            7 => [
                Form::SINGULAR => 'секстилион',
                Form::PLURAL => 'секстилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            8 => [
                Form::SINGULAR => 'септилион',
                Form::PLURAL => 'септилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            9 => [
                Form::SINGULAR => 'октилион',
                Form::PLURAL => 'октилиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
            10 => [
                Form::SINGULAR => 'ноналион',
                Form::PLURAL => 'ноналиони',
                GrammaticalGenderAwareInterface::GRAMMATICAL_GENDER => Gender::GENDER_MASCULINE,
            ],
        ],
    ];

    public function getSeparator(): string
    {
        return static::SEPARATOR;
    }

    public function getZero(): string
    {
        return static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][0];
    }

    public function getMinus(): string
    {
        return static::ARITHMETIC_MINUS;
    }

    public function getCorrespondingUnit(int $unit): string
    {
        $result = static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][$unit];

        if (is_array($result)) {
            $result = $result[Gender::GENDER_ABSTRACT];
        }

        return $result;
    }

    public function getCorrespondingUnitForGrammaticalGender(int $unit, string $grammaticalGender): string
    {
        $result = static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][$unit];

        if (is_array($result)) {
            $result = $result[$grammaticalGender];
        }

        return $result;
    }

    public function getCorrespondingTeen(int $teen): string
    {
        return static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][$teen];
    }

    public function getCorrespondingTen(int $ten): string
    {
        return static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][$ten];
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        return static::ENUMERATIONS[static::ENUMERATION_BY_VALUE][$hundred];
    }
}
