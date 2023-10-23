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
    nppdvjthqldpwncqszvftbrmjlhg
    txt;

test('Part One: Example B', function () {
    $input = EXAMPLE_06b;
    expect(Day06::partOne($input))->toBe(6);
});

const EXAMPLE_06c = <<<txt
    bvwbjplbgvbhsrlpgdmjqwftvncz
    txt;

test('Part One: Example C', function () {
    $input = EXAMPLE_06c;
    expect(Day06::partOne($input))->toBe(5);
});

const EXAMPLE_06d = <<<txt
    nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg
    txt;

test('Part One: Example k', function () {
    $input = EXAMPLE_06d;
    expect(Day06::partOne($input))->toBe(10);
});

const EXAMPLE_06e = <<<txt
    zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw
    txt;

test('Part One: Example E', function () {
    $input = EXAMPLE_06e;
    expect(Day06::partOne($input))->toBe(11);
});

 test('Part One: Puzzle', function () {
     $input = file_get_contents(at('TwentyTwo/06.txt'));
     expect(Day06::partOne($input))->toBe(1262);
 });

test('Part Two: Example A', function () {
    $input = EXAMPLE_06a;
    expect(Day06::partTwo($input))->toBe(19);
});

test('Part Two: Example B', function () {
    $input = EXAMPLE_06b;
    expect(Day06::partTwo($input))->toBe(23);
});

test('Part Two: Example C', function () {
    $input = EXAMPLE_06c;
    expect(Day06::partTwo($input))->toBe(23);
});

test('Part Two: Example D', function () {
    $input = EXAMPLE_06d;
    expect(Day06::partTwo($input))->toBe(29);
});

test('Part Two: Example E', function () {
     $input = EXAMPLE_06e;
     expect(Day06::partTwo($input))->toBe(26);
 });

 test('Part Two: Puzzle', function () {
     $input = file_get_contents(at('TwentyTwo/06.txt'));
     expect(Day06::partTwo($input))->toBe(3444);
 });
