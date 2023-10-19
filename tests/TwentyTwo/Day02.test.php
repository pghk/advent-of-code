<?php

use App\TwentyTwo\Day02;

const EXAMPLE_02 = <<<txt
    A Y
    B X
    C Z
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_02);
    expect(Day02::partOne($input))->toBe(15);
});

test('Part One: Puzzle', function () {
    $input = file(at('/2022/02.txt'), FILE_IGNORE_NEW_LINES);
    expect(Day02::partOne($input))->toBe(13009);
});

test('Part Two: Example', function () {
    $input = explode("\n", EXAMPLE_02);
    expect(Day02::partTwo($input))->toBe(12);
});

test('Part Two: Puzzle', function () {
    $input = file(at('/2022/02.txt'), FILE_IGNORE_NEW_LINES);
    expect(Day02::partTwo($input))->toBe(10398);
});
