<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laudis\Neo4j\Contracts\ClientInterface;

class TestingNeo4JController extends Controller
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    public function index(): JsonResponse
    {
        $result = $this->neo4jClient->run(<<<'CYPHER'
CREATE (p:Person {name: 'Manuel Rocha'})
RETURN p
CYPHER, ['dbName' => 'neo4j'])->first();

        $person = $result->get('p');

        return new JsonResponse(['person' => $person]);
    }
}
