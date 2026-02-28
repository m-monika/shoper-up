<?php

declare(strict_types=1);

namespace App;

class Car
{
    private string $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function paint(string $newColor): void
    {
        $this->color = $newColor;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
