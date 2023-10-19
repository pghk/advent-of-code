<?php

use App\TwentyTwo\Day01;

const EXAMPLE_01 = <<<txt

    1000
    2000
    3000

    4000

    5000
    6000    

    7000
    8000
    9000

    10000

    txt;


test('Part One: Example', function () {
    expect(Day01::partOne(EXAMPLE_01))->toBe(24000);
});

test('Part One: Puzzle', function () {
    $input = file_get_contents(at('/2022/01.txt'));
    expect(Day01::partOne($input))->toBe(71934);
});

test('Part Two: Example', function () {
    expect(Day01::partTwo(EXAMPLE_01))->toBe(45000);
});

test('Part Two: Puzzle', function () {
    $input = file_get_contents(at('/2022/01.txt'));
    expect(Day01::partTwo($input))->toBe(211447);
});
