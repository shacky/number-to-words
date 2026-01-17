<?php

namespace NumberToWords\Language;

/**
 * Extended PowerAwareTripletTransformer interface that provides context about all triplets.
 * This allows transformers to make decisions based on whether zero triplets exist at lower powers.
 * 
 * Useful for languages like Portuguese where conjunction " e " placement depends on whether
 * the last triplet (power 0) is zero or not.
 */
interface TripletContextAwareTripletTransformer extends PowerAwareTripletTransformer
{
    /**
     * Transform a triplet to words with full context about all triplets in the number.
     *
     * @param int $number The triplet value (0-999)
     * @param int $power The power of the triplet (0 for units, 1 for thousands, 2 for millions, etc.)
     * @param array $allTriplets Array of all triplets indexed by power (includes zeros)
     * @return string|null The words for this triplet, or null to omit
     */
    public function transformToWordsWithContext(int $number, int $power, array $allTriplets): ?string;
}
