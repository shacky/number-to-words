# Legacy Migration Guide

## Overview
This document guides the migration of language implementations from `src/Legacy/Numbers/Words` to the new `NumberTransformerBuilder` architecture.

## Migration Status

### ✅ Completed Migrations (30 languages)
These languages now use `NumberTransformerBuilder` exclusively. Legacy implementations have been removed:

**Originally Migrated:**
- English, Polish, German, Slovak, Serbian
- Azerbaijani, Albanian, Arabic, Kurdish
- Latvian, Persian, Uzbek

**Newly Migrated in This PR:**
- **Czech (Cs)** - 139 tests - Uses PowerAwareTripletTransformer with gender inflection
- **Turkish (Tr)** - 47 tests - PowerAwareTripletTransformer for "bin" without "bir"
- **Turkmen (Tk)** - 66 tests - Simple space-separated concatenation
- **Swedish (Sv)** - 22 tests - Regular TripletTransformer
- **Danish (Dk)** - 12 tests - Regular TripletTransformer
- **Ukrainian (Ua)** - 42 tests - Gender-aware (male/female) with Slavic inflection
- **Russian (Ru)** - 71 tests - Gender-aware (male/female) with Slavic inflection
- **Spanish (Es)** - 91 tests - Complex patterns: cien/ciento, veinti-compounds, long scale
- **Estonian (Et)** - 47 tests - Compound words (unit+"sada", unit+"kümmend")
- **Hungarian (Hu)** - 96 tests - Compound words with conditional separator
- **Italian (It)** - Vowel elision, conditional spacing, mille/mila inflection
- **Dutch (Nl)** - 57 tests - PowerAwareTripletTransformer with conjunction logic for thousands
- **Macedonian (Mk)** - 82 tests - PowerAwareTripletTransformer with complex "и" conjunction rules and gender inflection
- **Georgian (Ka)** - 111 tests - PowerAwareTripletTransformer with vigesimal (base-20) system and "და" conjunction
- **French (Fr)** - 117 tests - PowerAwareTripletTransformer with vigesimal patterns for 60-99 and "et" conjunction
- **French Belgian (Fr/Be)** - 59 tests - PowerAwareTripletTransformer with "septante"/"nonante" instead of vigesimal 70/90
- **Portuguese Portugal (Pt/Pt)** - 103 tests - PowerAwareTripletTransformer with context-aware " e " conjunction, "cem"/"cento" handling, long scale (mil milhões)
- **Portuguese Brazil (Pt/Br)** - 103 tests - PowerAwareTripletTransformer with context-aware " e " conjunction, "cem"/"cento" handling, short scale (bilhão)
- **Lithuanian (Lt)** - 43 tests - PowerAwareTripletTransformer with Slavic-style inflection for thousands/millions
- **Indonesian (Id)** - PowerAwareTripletTransformer with seribu special-case handled via exponent inflection

### ⚠️ Partial Migrations (2 languages)
These have `Language/` components but `NumberTransformer` still uses Legacy:
- **Bulgarian** - Has all components but needs architectural enhancement for conjunction logic
- **Romanian** - Only has Dictionary

### ❌ Pending Migrations (2 languages)
Need complete migration (no Language/ folder exists):
- Swahili (Sw)
- Yoruba (Yo)

**Progress:** 29 of 36 languages fully migrated (81%)

## Migration Steps

**Currency coverage:** when migrating a language, ensure its `*Dictionary.php` defines the full currency set present in `EnglishDictionary::$currencyNames`, with localized major/minor unit names (singular/plural) sourced from the canonical Google currencies CSV (`https://developers.google.com/public-data/docs/canonical/currencies_csv?hl=<language_code>`). Do not copy English names; add proper localized labels for both units and subunits. Keep original translations from legacy file if exists.

### For Simple Languages (follows standard pattern)

1. **Create Language Directory**
   ```
   src/Language/[LanguageName]/
   ```

2. **Create Dictionary** (`[Language]Dictionary.php`)
   - Implement `Dictionary` interface
   - Define zero, minus, exponents
   - Define units, tens, teens, hundreds
   - Add currency mappings if needed

3. **Create TripletTransformer** (`[Language]TripletTransformer.php`)
   - For simple languages: implement `TripletTransformer`
   - For complex languages: implement `PowerAwareTripletTransformer`
   - Convert triplet (0-999) to words

4. **Create Exponent Handler**
   - Either `[Language]ExponentInflector` (implements `ExponentInflector`)
   - Or `[Language]ExponentGetter` (implements `ExponentGetter`)
   - Handle thousand, million, billion, etc.

5. **Optional: Create NounGenderInflector**
   - If language has grammatical gender inflection
   - Implements noun declension rules

6. **Update NumberTransformer**
   - Replace Legacy `Words` usage
   - Use `NumberTransformerBuilder` pattern
   - Example:
   ```php
   public function toWords(int $number): string
   {
       $dictionary = new [Language]Dictionary();
       $numberToTripletsConverter = new NumberToTripletsConverter();
       $tripletTransformer = new [Language]TripletTransformer($dictionary);
       $exponentInflector = new [Language]ExponentInflector();

       $numberTransformer = (new NumberTransformerBuilder())
           ->withDictionary($dictionary)
           ->withWordsSeparatedBy(' ')
           ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
           ->inflectExponentByNumbers($exponentInflector)
           ->build();

       return $numberTransformer->toWords($number);
   }
   ```

7. **Test**
   - Run existing tests for the language
   - Example: `vendor/bin/phpunit --filter CzechNumberTransformerTest`
   - All tests must pass before migration is complete

## Templates

### Use as Templates
- **Slovak** - Simple language with inflection
- **German** - Uses PowerAwareTripletTransformer
- **English** - Simple language with ExponentGetter
- **Polish** - Complex inflection with NounGenderInflector
- **Czech** - Slavic inflection similar to Slovak
- **Turkish** - PowerAwareTripletTransformer for omitting prefix
- **Spanish** - Complex patterns with PowerAwareExponentInflector
- **Ukrainian/Russian** - Gender-aware Slavic languages
- **Estonian** - Finno-Ugric compound words
- **Hungarian** - Conditional separator based on number range
- **Italian** - Vowel elision and conditional spacing

## Architecture Enhancements

### PowerAwareExponentInflector Interface ✅
Created to solve Spanish long scale numbering issue (commit 7ecfacd).

**Problem:** Spanish uses "mil millones" for 1,000,000,000 when standalone, but just "mil" when part of larger numbers.

**Solution:** Extended `ExponentInflector` with context-aware variant:
- `inflectExponentWithContext()` provides `maxPower` and `nonZeroTripletCount`
- `GenericNumberTransformer` auto-detects and uses enhanced interface
- Backward compatible - existing implementations unaffected
- Enables languages to make context-aware exponent decisions

**Result:** Spanish now correctly handles all long scale patterns (91/91 tests passing).

## Known Issues

### Bulgarian Conjunction Problem (Still Pending)
Bulgarian requires "и" (and) between exponents and following triplets:
- `1001` should be "хиляда **и** едно" not "хиляда едно"

The current architecture doesn't support this because:
1. `TripletTransformer` doesn't know about other triplets
2. `ExponentInflector` doesn't know what follows
3. `GenericNumberTransformer` joins words with simple separator

**Possible Solutions:**
1. Extend `PowerAwareTripletTransformer` to receive more context
2. Create custom `NumberTransformer` for Bulgarian
3. Add callback/hook system to `GenericNumberTransformer`

**Note:** PowerAwareExponentInflector solved a similar context issue for Spanish, but Bulgarian needs triplet-level context.

## Testing

Run all tests:
```bash
vendor/bin/phpunit --no-coverage
```

Test specific language:
```bash
# Replace [Language] with actual language name, e.g.:
vendor/bin/phpunit --filter CzechNumberTransformerTest
vendor/bin/phpunit --filter SpanishNumberTransformerTest
```

## Estimated Effort

**Simple Language** (2-3 hours):
- Standard number patterns (0-999 follow predictable rules)
- Uses `TripletTransformer` interface
- Simple exponent naming (thousand, million, billion)
- No grammatical gender complications
- Examples: English, Czech (similar to Slovak)

**Complex Language** (4-6 hours):
- Grammatical gender inflection (numbers change based on noun gender)
- Irregular patterns in certain ranges
- Uses `PowerAwareTripletTransformer` interface
- Multiple forms for exponents based on number
- Requires `NounGenderInflector`
- Examples: Polish, Slovak, German

**Architectural Changes** (8-12 hours):
- Requires custom conjunction/separator logic
- Stateful transformations across triplets
- May need custom `NumberTransformer` implementation
- Examples: Bulgarian (conjunction between exponents)

## Questions?
Refer to existing implementations in `src/Language/` and `src/NumberTransformer/`.
