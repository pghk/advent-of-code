<?php

use App\Main;

const SAMPLE_ONE = <<<txt

    1000
    2000
    3000

    4000

    5000
    6000    

    7000
    8000
    9000

    10000

    txt;


test('example', function () {
    expect(Main::first(SAMPLE_ONE))->toBe(24000);
});

test('example 2', function () {
    expect(Main::second(SAMPLE_ONE))->toBe(45000);
});

test('puzzle', function () {
    $input = file_get_contents(dirname(__DIR__) . '/data/1.txt');
    expect(Main::first($input))->toBe(71934);
});

test('puzzle 2', function () {
    $input = file_get_contents(dirname(__DIR__) . '/data/1.txt');
    expect(Main::second($input))->toBe(211447);
});
