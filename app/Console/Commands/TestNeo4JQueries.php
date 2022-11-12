<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laudis\Neo4j\ClientBuilder;

class TestNeo4JQueries extends Command
{
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

        $client = ClientBuilder::create()->withDriver('default', 'bolt://developer:secret@localhost')->build();

        $result = $client->run(<<<'CYPHER'
CREATE (p:Person {name: 'Manuel Rocha'})
RETURN p
CYPHER, ['dbName' => 'neo4j'])->first();

        $person = $result->get('p');
        $this->info('Profile matched: '. $person->getProperty('name'));

        info('result', ['neo4j' => $result]);

        $this->info('Queries finished successfully.');

        return Command::SUCCESS;
    }
}
