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
        foreach ($rows as $row) {
            if (null !== $row[1]) {
                $this->neo4jClient->run(<<<'CYPHER'
MERGE(p:Person {name: $name}) RETURN p
CYPHER, ['name' => $row[1]]);
            }
        }
    }
}
