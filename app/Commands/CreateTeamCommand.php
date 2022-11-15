<?php declare(strict_types=1);

namespace App\Commands;

class CreateTeamCommand
{
    private array $row;


    // @TODO: add docs specifying the contents of array $row
    public function __construct(array $row)
    {
        $this->row = $row;
    }

    public function getRow(): array
    {
        return $this->row;
    }
}
