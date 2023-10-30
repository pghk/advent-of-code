<?php

use App\TwentyTwo\Day08;

const EXAMPLE_08 = <<<txt
    30373
    25512
    65332
    33549
    35390
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_08);
    $sys = new Day08($input);
    expect($sys->partOne())->toBe(21);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyTwo/08.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day08($input);
     expect($sys->partOne())->toBe(1698);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_08);
     $sys = new Day08($input);
     expect($sys->partTwo())->toBe(8);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyTwo/08.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day08($input);
     expect($sys->partTwo())->toBe(672280);
 });
