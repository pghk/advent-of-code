<?php

use App\TwentyTwo\Day11;

const EXAMPLE_11 = <<<txt
    Monkey 0:
      Starting items: 79, 98
      Operation: new = old * 19
      Test: divisible by 23
        If true: throw to monkey 2
        If false: throw to monkey 3

    Monkey 1:
      Starting items: 54, 65, 75, 74
      Operation: new = old + 6
      Test: divisible by 19
        If true: throw to monkey 2
        If false: throw to monkey 0

    Monkey 2:
      Starting items: 79, 60, 97
      Operation: new = old * old
      Test: divisible by 13
        If true: throw to monkey 1
        If false: throw to monkey 3

    Monkey 3:
      Starting items: 74
      Operation: new = old + 3
      Test: divisible by 17
        If true: throw to monkey 0
        If false: throw to monkey 1
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_11);
    $sys = new Day11($input);
    expect($sys->partOne())->toBe(10605);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyTwo/11.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day11($input);
     expect($sys->partOne())->toBe(64032);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_11);
     $sys = new Day11($input);
     expect($sys->partTwo())->toBe(2713310158);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyTwo/11.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day11($input);
     expect($sys->partTwo())->toBe(12729522272);
 });
