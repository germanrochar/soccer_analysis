<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Laudis\Neo4j\Contracts\ClientInterface;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTeams implements ToCollection
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
       $this->neo4jClient = $neo4jClient;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $result = $this->neo4jClient->run(<<<'CYPHER'
MERGE(p:Person {name: 'Testing'}) RETURN p
CYPHER, ['dbName' => 'neo4j'])->first();

        $person = $result->get('p');

        info('getting a person.', ['person' => $person]);

        foreach ($rows as $row) {
            info('testing.', ['row' => $row[0]]);
        }
    }
}
