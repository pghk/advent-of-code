<?php

namespace App\TwentyTwo;

class Day07
{
    const SPACE_TOTAL = 70000000;
    const SPACE_NEEDED = 30000000;

    private array $diskUsage = [];

    public function __construct(public array $input)
    {
        $this->analyze($this->input);
    }

    public function partOne(): int
    {
        $selected = array_filter($this->diskUsage, fn($s) => $s <= 100000);
        return array_sum(array_values($selected));
    }

    public function partTwo()
    {
        $size = self::SPACE_NEEDED - (self::SPACE_TOTAL - $this->diskUsage['/']);
        $selected = array_filter($this->diskUsage, fn($s) => $s >= $size);
        sort($selected);
        return $selected[0];
    }

    private function analyze($input): void
    {
        $path = [];
        array_walk($input, function ($i) use (&$path) {
            if (str_starts_with($i, '$ cd ')) {
                $this->trackLocation($i, $path);
                return;
            }
            $this->setDiskUsage($i, $path);
        });
    }

    private function trackLocation($cmd, array &$path): void
    {
        $dirname = explode(' ', $cmd)[2];
        $this::setPosition($dirname, $path);
    }

    private function setPosition($dir, &$path): void
    {
        match ($dir) {
            '/' => $path = ['/'],
            '..' => array_pop($path),
            default => $path[] = $dir,
        };
    }

    function setDiskUsage($i, array $path): void
    {
        $size = explode(' ', $i)[0];
        if (!is_numeric($size)) {
            return;
        }
        $this->collectSizes($path, (int)$size);
    }

    function collectSizes(array $path, int $size): void
    {
        for ($n = 1; $n <= count($path); $n++) {
            $k = join(':', array_slice($path, 0, $n));
            if (!array_key_exists($k, $this->diskUsage)) {
                $this->diskUsage[$k] = 0;
            }
            $this->diskUsage[$k] += $size;
        }
    }


}
