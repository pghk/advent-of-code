<?php

use App\TwentyTwo\Day07;

const EXAMPLE_07 = <<<txt
    $ cd /
    $ ls
    dir a
    14848514 b.txt
    8504156 c.dat
    dir d
    $ cd a
    $ ls
    dir e
    29116 f
    2557 g
    62596 h.lst
    $ cd e
    $ ls
    584 i
    $ cd ..
    $ cd ..
    $ cd d
    $ ls
    4060174 j
    8033020 d.log
    5626152 d.ext
    7214296 k
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_07);
    $test = new Day07($input);
    expect($test->partOne())->toBe(95437);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyTwo/07.txt'), FILE_IGNORE_NEW_LINES);
     $test = new Day07($input);
     expect($test->partOne())->toBe(1086293);
 });

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_07);
//     expect(Day07::partTwo($input))->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyTwo/07.txt'), FILE_IGNORE_NEW_LINES);
//     expect(Day07::partTwo($input))->toBe(0);
// });
