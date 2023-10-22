<?php

use App\TwentyTwo\Day03;

const EXAMPLE_03 = <<<txt
    vJrwpWtwJgWrhcsFMMfFFhFp
    jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
    PmmdzqPrVvPwwTWBwg
    wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
    ttgJtRGJQctTZtZT
    CrZsJsPPZsGzwwsLwLmpwMDw
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_03);
    $t = new Day03();
    expect($t->partOne($input))->toBe(157);
});

test('Part One: Puzzle', function () {
    $input = file(at('2022/03.txt'), FILE_IGNORE_NEW_LINES);
    $t = new Day03();
    expect($t->partOne($input))->toBe(7428);
});

test('Part Two: Example', function () {
    $input = explode("\n", EXAMPLE_03);
    $t = new Day03();
    expect($t->partTwo($input))->toBe(70);
});

test('Part Two: Puzzle', function () {
    $input = file(at('2022/03.txt'), FILE_IGNORE_NEW_LINES);
    $t = new Day03();
    expect($t->partTwo($input))->toBe(2650);
});
