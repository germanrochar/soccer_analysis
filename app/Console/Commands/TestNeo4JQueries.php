<?php

namespace App\Console\Commands;

use App\Imports\ImportTeams;
use Illuminate\Console\Command;
use Laudis\Neo4j\Contracts\ClientInterface;
use Maatwebsite\Excel\Facades\Excel;

class TestNeo4JQueries extends Command
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
        parent::__construct();

        $this->neo4jClient = $neo4jClient;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'neo4j:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Neo4J queries';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Running Neo4J Queries...');
//        $result = $this->neo4jClient->run(<<<'CYPHER'
//LOAD CSV FROM 'https://soccer-csv-files.s3.us-west-2.amazonaws.com/all_players.csv' as line
//MERGE(p:Person {name: line[1]})
//CYPHER, ['dbName' => 'neo4j'])->first();
//
//        $person = $result->get('p');
//        $this->info('Profile matched: '. $person->getProperty('name'));
//
//        info('result', ['neo4j' => $result]);

        $this->info('Queries finished successfully.');

        return Command::SUCCESS;
    }
}
