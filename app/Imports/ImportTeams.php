<?php

namespace App\Imports;

use App\CommandBus;
use App\Commands\CreateSeasonCommand;
use App\Commands\CreateTeamsCommand;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTeams implements ToCollection
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
       $this->commandBus  = $commandBus;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $this->commandBus->handle(new CreateSeasonCommand('2022-2023'));

        $counter = 0;
        foreach ($rows as $row) {
            if ($counter < 2) {
                $counter++;
                continue;
            }

            $this->commandBus->handle(new CreateTeamsCommand($row->toArray()));
        }
    }
}
