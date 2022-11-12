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
MERGE (neo4j:Database {name: $dbName}) - [:HasRating] - (rating:Rating {value: 10})
RETURN neo4j, rating
CYPHER, ['dbName' => 'neo4j'])->first();

        $neo4j = $result->get('neo4j');
        $rating = $result->get('rating');

        // Outputs "neo4j is 10 out of 10"
        echo $neo4j->getProperty('name').' is '.$rating->getProperty('value') . ' out of 10!';

        return Command::SUCCESS;
    }
}
