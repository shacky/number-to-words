<?php

namespace NumberToWords\Language;

interface PowerAwareTripletTransformer
{
    /**
     * Transform a triplet to words with power awareness.
     *
     * @param int $number The triplet value (0-999)
     * @param int $power The power of the triplet (0 for units, 1 for thousands, 2 for millions, etc.)
     * @param array $allTriplets Optional. Array of all triplets indexed by power (includes zeros).
     *                           Useful for languages where conjunction placement depends on context.
     * @return string|null The words for this triplet, or null to omit
     */
    public function transformToWords(int $number, int $power, array $allTriplets = []): ?string;
}
