# Legacy Migration Guide

## Overview
This document guides the migration of language implementations from `src/Legacy/Numbers/Words` to the new `NumberTransformerBuilder` architecture.

## Migration Status

### ✅ Completed Migrations
These languages already use `NumberTransformerBuilder`:
- English, Polish, German, Slovak, Serbian
- Azerbaijani, Albanian, Arabic, Kurdish
- Latvian, Persian, Uzbek

### ⚠️ Partial Migrations  
These have `Language/` components but `NumberTransformer` still uses Legacy:
- **Bulgarian** - Has all components but needs architectural enhancement for conjunction logic
- **Lithuanian** - Only has Dictionary
- **Romanian** - Only has Dictionary
- **French** - Only has BelgianDictionary

### ❌ Pending Migrations
Need complete migration (no Language/ folder exists):
- Czech (Cs), Danish (Dk), Spanish (Es), Estonian (Et)
- Hungarian (Hu), Indonesian (Id), Italian (It), Georgian (Ka)
- Macedonian (Mk), Malay (Ms), Dutch (Nl)
- Portuguese Portugal (Pt/Pt), Portuguese Brazil (Pt/Br)
- Russian (Ru), Swedish (Sv), Swahili (Sw)
- Turkmen (Tk), Turkish (Tr), Ukrainian (Ua), Yoruba (Yo)
- French Belgian (Fr/Be)

## Migration Steps

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

## Known Issues

### Bulgarian Conjunction Problem
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
- Simple language (like Slovak): 2-3 hours
- Complex language (like Polish): 4-6 hours  
- Architectural changes (like Bulgarian): 8-12 hours

## Questions?
Refer to existing implementations in `src/Language/` and `src/NumberTransformer/`.
