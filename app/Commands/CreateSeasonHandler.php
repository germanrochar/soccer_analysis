<?php declare(strict_types=1);

namespace App\Commands;

use Laudis\Neo4j\Contracts\ClientInterface;

class CreateSeasonHandler
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    public function __invoke(CreateSeasonCommand $command): void
    {
        $this->neo4jClient->run(<<<'CYPHER'
MERGE(s:Season {name: $name})
CYPHER, ['name' => $command->getSeasonName()]);
    }
}
