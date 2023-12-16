<?php

use App\TwentyThree\Day10;

const EXAMPLE_10a = <<<txt
    .....
    .S-7.
    .|.|.
    .L-J.
    .....
    txt;

test('Part One: Example A', function () {
    $input = explode("\n", EXAMPLE_10a);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(4);
});

const EXAMPLE_10b = <<<txt
    -L|F7
    7S-7|
    L|7||
    -L-J|
    L|-JF
    txt;

test('Part One: Example B', function () {
    $input = explode("\n", EXAMPLE_10b);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(4);
});

const EXAMPLE_10c = <<<txt
    7-F7-
    .FJ|7
    SJLL7
    |F--J
    LJ.LJ
    txt;

test('Part One: Example C', function () {
    $input = explode("\n", EXAMPLE_10c);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(8);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/10.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day10($input);
     expect($sys->partOne())->toBe(6828);
 });

const EXAMPLE_10d = <<<txt
    ...........
    .S-------7.
    .|F-----7|.
    .||.....||.
    .||.....||.
    .|L-7.F-J|.
    .|..|.|..|.
    .L--J.L--J.
    ...........
    txt;

test('Part Two: Example D', function () {
    $input = explode("\n", EXAMPLE_10d);
    $sys = new Day10($input);
    expect($sys->partTwo())->toBe(4);
});

const EXAMPLE_10e = <<<txt
    .F----7F7F7F7F-7....
    .|F--7||||||||FJ....
    .||.FJ||||||||L7....
    FJL7L7LJLJ||LJ.L-7..
    L--J.L7...LJS7F-7L7.
    ....F-J..F7FJ|L7L7L7
    ....L7.F7||L7|.L7L7|
    .....|FJLJ|FJ|F7|.LJ
    ....FJL-7.||.||||...
    ....L---J.LJ.LJLJ...
    txt;

test('Part Two: Example E', function () {
    $input = explode("\n", EXAMPLE_10e);
    $sys = new Day10($input);
    expect($sys->partTwo())->toBe(8);
});

const EXAMPLE_10f = <<<txt
    FF7FSF7F7F7F7F7F---7
    L|LJ||||||||||||F--J
    FL-7LJLJ||||||LJL-77
    F--JF--7||LJLJ7F7FJ-
    L---JF-JLJ.||-FJLJJ7
    |F|F-JF---7F7-L7L|7|
    |FFJF7L7F-JF7|JL---7
    7-L-JL7||F7|L7F-7F7|
    L.L7LFJ|||||FJL7||LJ
    L7JLJL-JLJLJL--JLJ.L
    txt;

test('Part Two: Example F', function () {
     $input = explode("\n", EXAMPLE_10f);
     $sys = new Day10($input);
     expect($sys->partTwo())->toBe(10);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyThree/10.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day10($input);
     expect($sys->partTwo())->toBe(459);
 });
