<?php

namespace App\TwentyTwo;

class Day07
{
    private array $pos = [];
    private array $sizes = [];

    public function partOne($input): int
    {
        array_walk($input, function ($v, $k) {
            if (str_starts_with($v, '$ cd '))
            {
                $path = str_replace('$ cd ', '', $v);
                $this::setPosition($path);
                return;
            }
            [$s, $n] = explode(' ', $v);
            if (!is_numeric($s)) {
                return;
            }
            foreach ($this->pos as $i => $p) {
                $path = $this->pos;
                $k = join(':', array_slice($path, 0, $i + 1));
                if (!array_key_exists($k, $this->sizes))
                {
                    $this->sizes[$k] = 0;
                }
                $this->sizes[$k] += (int)$s;
            }
        });
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
}
