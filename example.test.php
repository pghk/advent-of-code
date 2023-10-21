<?php

use App\YEAR\DayDAY;

const EXAMPLE_DAY = <<<txt

    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_DAY);
    expect(DayDAY::partOne($input))->toBe(0);
});

// test('Part One: Puzzle', function () {
//     $input = file(at('YEAR/DAY.txt'), FILE_IGNORE_NEW_LINES);
//     expect(DayDAY::partOne($input))->toBe(0);
// });
//
// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_DAY);
//     expect(DayDAY::partTwo($input))->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('YEAR/DAY.txt'), FILE_IGNORE_NEW_LINES);
//     expect(DayDAY::partTwo($input))->toBe(0);
// });
