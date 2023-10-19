<?php

use App\Day02;

const SAMPLE = <<<txt
    A Y
    B X
    C Z
    txt;


test('example', function () {
    $input = explode("\n", SAMPLE);
    expect(Day02::partOne($input))->toBe(15);
});

test('puzzle', function () {
    $input = file(dirname(__DIR__) . '/data/2.txt', FILE_IGNORE_NEW_LINES);
    expect(Day02::partOne($input))->toBe(13009);
});

test('example 2', function () {
    $input = explode("\n", SAMPLE);
    expect(Day02::partTwo($input))->toBe(12);
});

test('puzzle 2', function () {
    $input = file(dirname(__DIR__) . '/data/2.txt', FILE_IGNORE_NEW_LINES);
    expect(Day02::partTwo($input))->toBe(10398);
});
