<?php

use App\TwentyThree\Day05;

const EXAMPLE_05 = <<<txt
    seeds: 79 14 55 13

    seed-to-soil map:
    50 98 2
    52 50 48

    soil-to-fertilizer map:
    0 15 37
    37 52 2
    39 0 15

    fertilizer-to-water map:
    49 53 8
    0 11 42
    42 0 7
    57 7 4

    water-to-light map:
    88 18 7
    18 25 70

    light-to-temperature map:
    45 77 23
    81 45 19
    68 64 13

    temperature-to-humidity map:
    0 69 1
    1 0 69

    humidity-to-location map:
    60 56 37
    56 93 4
    txt;

test('Part One: Example', function () {
    $input = explode("\n\n", EXAMPLE_05);
    $sys = new Day05($input);
    expect($sys->partOne())->toBe(35);
});

test('Part One: Puzzle', function () {
    $input = explode("\n\n", file_get_contents(at('TwentyThree/05.txt')));
    $sys = new Day05($input);
    expect($sys->partOne())->toBe(282277027);
});

test('Part Two: Example', function () {
    $input = explode("\n\n", EXAMPLE_05);
    $sys = new Day05($input);
    expect($sys->partTwo())->toBe(46);
});

test('Part Two: Puzzle', function () {
    $input = explode("\n\n", file_get_contents(at('TwentyThree/05.txt')));
    $sys = new Day05($input);
    expect($sys->partTwo())->toBe(11554135);
});
