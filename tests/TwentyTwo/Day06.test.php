<?php

use App\TwentyTwo\Day06;

const EXAMPLE_06a = <<<txt
    mjqjpqmgbljsphdztnvjfqwrcgsmlb
    txt;

const EXAMPLE_06b = <<<txt
    nppdvjthqldpwncqszvftbrmjlhg
    txt;

const EXAMPLE_06c = <<<txt
    bvwbjplbgvbhsrlpgdmjqwftvncz
    txt;

const EXAMPLE_06d = <<<txt
    nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg
    txt;

const EXAMPLE_06e = <<<txt
    zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw
    txt;

test('Part One: Example A', function () {
    expect(Day06::partOne(EXAMPLE_06a))->toBe(7);
});

test('Part One: Example B', function () {
    expect(Day06::partOne(EXAMPLE_06b))->toBe(6);
});

test('Part One: Example C', function () {
    expect(Day06::partOne(EXAMPLE_06c))->toBe(5);
});

test('Part One: Example D', function () {
    expect(Day06::partOne(EXAMPLE_06d))->toBe(10);
});

test('Part One: Example E', function () {
    expect(Day06::partOne(EXAMPLE_06e))->toBe(11);
});

test('Part One: Puzzle', function () {
    $input = file_get_contents(at('TwentyTwo/06.txt'));
    expect(Day06::partOne($input))->toBe(1262);
});

test('Part Two: Example A', function () {
    expect(Day06::partTwo(EXAMPLE_06a))->toBe(19);
});

test('Part Two: Example B', function () {
    expect(Day06::partTwo(EXAMPLE_06b))->toBe(23);
});

test('Part Two: Example C', function () {
    expect(Day06::partTwo(EXAMPLE_06c))->toBe(23);
});

test('Part Two: Example D', function () {
    expect(Day06::partTwo(EXAMPLE_06d))->toBe(29);
});

test('Part Two: Example E', function () {
    expect(Day06::partTwo(EXAMPLE_06e))->toBe(26);
});

test('Part Two: Puzzle', function () {
    $input = file_get_contents(at('TwentyTwo/06.txt'));
    expect(Day06::partTwo($input))->toBe(3444);
});
