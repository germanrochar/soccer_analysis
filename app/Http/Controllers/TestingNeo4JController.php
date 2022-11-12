<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
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
        // Create a new person in graph database
        $result = $this->neo4jClient->run(<<<'CYPHER'
CREATE (p:Person {name: 'German Rocha'})
RETURN p
CYPHER, ['dbName' => Config::get('database.connections.neo4j.database')])->first();

        $person = $result->get('p');

        return new JsonResponse(['person' => $person]);
    }
}
