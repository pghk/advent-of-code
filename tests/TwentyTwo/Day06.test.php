<?php

use App\TwentyTwo\Day06;

const EXAMPLE_06a = <<<txt
    mjqjpqmgbljsphdztnvjfqwrcgsmlb
    txt;

test('Part One: Example A', function () {
    $input = EXAMPLE_06a;
    expect(Day06::partOne($input))->toBe(7);
});

const EXAMPLE_06b = <<<txt
    bvwbjplbgvbhsrlpgdmjqwftvncz
    txt;

test('Part One: Example B', function () {
    $input = EXAMPLE_06b;
    expect(Day06::partOne($input))->toBe(5);
});

const EXAMPLE_06c = <<<txt
    nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg
    txt;

test('Part One: Example C', function () {
    $input = EXAMPLE_06c;
    expect(Day06::partOne($input))->toBe(10);
});

const EXAMPLE_06d = <<<txt
    zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw
    txt;

test('Part One: Example D', function () {
    $input = EXAMPLE_06d;
    expect(Day06::partOne($input))->toBe(11);
});

 test('Part One: Puzzle', function () {
     $input = file_get_contents(at('TwentyTwo/06.txt'));
     expect(Day06::partOne($input))->toBe(1262);
 });

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_06);
//     expect(Day06::partTwo($input))->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyTwo/06.txt'), FILE_IGNORE_NEW_LINES);
//     expect(Day06::partTwo($input))->toBe(0);
// });
