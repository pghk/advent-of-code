<?php

use App\TwentyTwo\Day05;

const EXAMPLE_05 = <<<txt
        [D]    
    [N] [C]    
    [Z] [M] [P]
     1   2   3 

    move 1 from 2 to 1
    move 3 from 1 to 3
    move 2 from 2 to 1
    move 1 from 1 to 2
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_05);
    expect(Day05::partOne($input))->toBe('CMZ');
});

 test('Part One: Puzzle', function () {
     $input = file(at('2022/05.txt'), FILE_IGNORE_NEW_LINES);
     expect(Day05::partOne($input))->toBe('WHTLRMZRC');
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_05);
     expect(Day05::partTwo($input))->toBe('MCD');
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('2022/05.txt'), FILE_IGNORE_NEW_LINES);
     expect(Day05::partTwo($input))->toBe('GMPMLWNMG');
 });
