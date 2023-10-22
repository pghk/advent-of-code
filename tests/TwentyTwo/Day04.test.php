<?php

use App\TwentyTwo\Day04;

const EXAMPLE_04 = <<<txt
    2-4,6-8
    2-3,4-5
    5-7,7-9
    2-8,3-7
    6-6,4-6
    2-6,4-8
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_04);
    expect(Day04::partOne($input))->toBe(2);
});

test('Part One: Puzzle', function () {
    $input = file(at('2022/04.txt'), FILE_IGNORE_NEW_LINES);
    expect(Day04::partOne($input))->toBe(515);
});

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_04);
//     expect(Day04::partTwo($input))->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('/04.txt'), FILE_IGNORE_NEW_LINES);
//     expect(Day04::partTwo($input))->toBe(0);
// });
