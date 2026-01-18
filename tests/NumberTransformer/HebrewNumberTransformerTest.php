<?php

namespace NumberToWords\NumberTransformer;

class HebrewNumberTransformerTest extends NumberTransformerTest
{
    protected function setUp(): void
    {
        $this->numberTransformer = new HebrewNumberTransformer();
    }

    public function providerItConvertsNumbersToWords(): array
    {
        return [
            [-345, 'מינוס שלוש מאות ארבעים וחמש'],
            [0, 'אפס'],
            [1, 'אחד'],
            [2, 'שתיים'],
            [11, 'אחד עשרה'],
            [19, 'תשע עשרה'],
            [21, 'עשרים ואחד'],
            [45, 'ארבעים וחמש'],
            [99, 'תשעים ותשע'],
            [100, 'מאה'],
            [101, 'מאה ואחד'],
            [110, 'מאה ועשר'],
            [569, 'חמש מאות שישים ותשע'],
            [999, 'תשע מאות תשעים ותשע'],
            [1000, 'אלף'],
            [1001, 'אלף אחד'],
            [1011, 'אלף אחד עשרה'],
            [2345, 'אלפיים שלוש מאות ארבעים וחמש'],
            [9999, 'תשעת אלפים תשע מאות תשעים ותשע'],
        ];
    }
}
