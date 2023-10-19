#! /usr/bin/env sh

FILE=app/${1}/Day${2}.php
cp example.php $FILE &&
	sed -i '' "s/YEAR/$1/" $FILE &&
	sed -i '' "s/DAY/$2/" $FILE

TEST=tests/${1}/Day${2}.test.php
cp example.test.php $TEST &&
	sed -i '' "s/YEAR/$1/" $TEST &&
	sed -i '' "s/DAY/$2/" $TEST
