<?php

namespace App\TwentyTwo;

class Day07
{
    private array $pos = [];
    private array $sizes = [];

    public function __construct(public array $input) {}

    public function partOne(): int
    {
        $this->analyze($this->input);
        $selected = array_filter($this->sizes, fn($s) => $s <= 100000);
        return array_sum(array_values($selected));
    }

    // public static function partTwo($input)
    // {
    //
    // }

    private function setPosition($path): void
    {
        switch ($path) {
            case '/':
                $this->pos = ['/'];
                break;
            case '..':
                array_pop($this->pos);
                break;
            default:
                $this->pos[] = $path;
        }
    }

    public function analyze($input): void
    {
        array_walk($input, function ($v) {
            if (str_starts_with($v, '$ cd ')) {
                $dir = explode(' ', $v)[2];
                $this::setPosition($dir);
                return;
            }
            $s = explode(' ', $v)[0];
            if (!is_numeric($s)) {
                return;
            }
            foreach ($this->pos as $i => $p) {
                $path = $this->pos;
                $k = join(':', array_slice($path, 0, $i + 1));
                if (!array_key_exists($k, $this->sizes)) {
                    $this->sizes[$k] = 0;
                }
                $this->sizes[$k] += (int)$s;
            }
        });
    }
}
