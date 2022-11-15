<?php

namespace App\Imports;

use App\CommandBus;
use App\Commands\CreateSeasonCommand;
use Illuminate\Support\Collection;
use Laudis\Neo4j\Contracts\ClientInterface;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportPlayers implements ToCollection
{
    private ClientInterface $neo4jClient;
    private CommandBus $commandBus;

    public function __construct(ClientInterface $neo4jClient, CommandBus $commandBus)
    {
       $this->neo4jClient = $neo4jClient;
       $this->commandBus = $commandBus;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        // Possible actions for commands/repositories
        // Create a season - Done
        // Create a team
        // Create a player
        // Create a manager
        // Create a national team
        // Relate player -> season
        // Relate manager -> team
        // Relate player -> national team
        // Relate player -> team
        // Relate team -> season


        $this->commandBus->handle(new CreateSeasonCommand('2022-2023'));

        $counter = 0;
        foreach ($rows as $row) {
            if ($counter === 0) {
                $counter++;
                continue;
            }
        }
    }
}
