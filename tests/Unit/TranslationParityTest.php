<?php

$langPath = dirname(__DIR__, 2).'/resources/lang';

$flatten = function (array $strings, string $prefix = '') use (&$flatten): array {
    $flat = [];
    foreach ($strings as $key => $value) {
        is_array($value)
            ? $flat += $flatten($value, "{$prefix}{$key}.")
            : $flat["{$prefix}{$key}"] = $value;
    }

    return $flat;
};

$load = fn (string $locale): array => $flatten(require "{$langPath}/{$locale}/knowledge-base.php");

// Plural segments are not compared: Polish, Russian and Ukrainian need three forms, Japanese one.
$placeholders = function (string $value): array {
    preg_match_all('/:([A-Za-z_]+)/', $value, $matches);
    $names = array_unique($matches[1]);
    sort($names);

    return $names;
};

dataset('locales', array_values(array_diff(
    array_map('basename', glob("{$langPath}/*", GLOB_ONLYDIR)),
    ['en'],
)));

it('has every English key and no other', function (string $locale) use ($load) {
    $english = $load('en');
    $translated = $load($locale);

    expect(array_keys(array_diff_key($english, $translated)))->toBe([], "{$locale} misses keys")
        ->and(array_keys(array_diff_key($translated, $english)))->toBe([], "{$locale} has keys English does not have");
})->with('locales');

it('uses the same placeholders as English', function (string $locale) use ($load, $placeholders) {
    $translated = $load($locale);
    $mismatches = [];

    foreach ($load('en') as $key => $english) {
        if (isset($translated[$key]) && $placeholders($translated[$key]) !== $placeholders($english)) {
            $mismatches[] = $key;
        }
    }

    expect($mismatches)->toBe([], "{$locale} uses other placeholders than English");
})->with('locales');
