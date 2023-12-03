<?php

use App\TwentyTwo\Day13;

const EXAMPLE_13 = <<<txt
    [1,1,3,1,1]
    [1,1,5,1,1]

    [[1],[2,3,4]]
    [[1],4]

    [9]
    [[8,7,6]]

    [[4,4],4,4]
    [[4,4],4,4,4]

    [7,7,7,7]
    [7,7,7]

    []
    [3]

    [[[]]]
    [[]]

    [1,[2,[3,[4,[5,6,7]]]],8,9]
    [1,[2,[3,[4,[5,6,0]]]],8,9]
    txt;

test('Part One: Example', function () {
    $input = explode("\n\n", EXAMPLE_13);
    $sys = new Day13($input);
    expect($sys->partOne())->toBe(13);
});

 test('Part One: Puzzle', function () {
     $input = explode("\n\n", file_get_contents(at('TwentyTwo/13.txt')));
     $sys = new Day13($input);
     expect($sys->partOne())->toBe(6568);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_13);
     $sys = new Day13($input);
     expect($sys->partTwo())->toBe(140);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyTwo/13.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day13($input);
     expect($sys->partTwo())->toBe(0);
 });
