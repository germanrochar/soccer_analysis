<?php declare(strict_types=1);

namespace App\Commands;

class CreateSeasonCommand
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getSeasonName(): string
    {
        return $this->name;
    }
}
