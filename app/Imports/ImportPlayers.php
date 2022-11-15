<?php

namespace App\Imports;

use App\CommandBus;
use App\Commands\CreatePlayerCommand;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportPlayers implements ToCollection
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
       $this->commandBus = $commandBus;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $counter = 0;
        foreach ($rows as $row) {
            if ($counter < 2) {
                $counter++;
                continue;
            }

            $this->commandBus->handle(new CreatePlayerCommand($row->toArray()));
        }
    }
}
