<?php

namespace App\Console\Commands;

use App\CommandBus;
use App\Imports\ImportPlayers;
use App\Imports\ImportTeams;
use Illuminate\Console\Command;
use Laudis\Neo4j\Contracts\ClientInterface;
use Maatwebsite\Excel\Facades\Excel;

class PopulateGraphDBFromCSV extends Command
{
    private ClientInterface $neo4jClient;
    private CommandBus $commandBus;

    public function __construct(ClientInterface $neo4jClient, CommandBus $commandBus)
    {
        parent::__construct();

        $this->neo4jClient = $neo4jClient;
        $this->commandBus = $commandBus;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate Graph Database from CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Importing data...');

        // TODO: create a new command to import data from csv file and set up the database.
        // TODO: set up constraints for each node

        Excel::import(new ImportTeams($this->commandBus), 'all_teams.csv', 's3');
//        Excel::import(new ImportPlayers($this->neo4jClient, $this->commandBus), 'all_players.csv', 's3');

        $this->info('CSV data imported successfully.');

        return Command::SUCCESS;
    }
}
