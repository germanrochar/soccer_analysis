<?php declare(strict_types=1);

namespace App\Commands;

use Laudis\Neo4j\Contracts\ClientInterface;

class CreateTeamHandler
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    public function __invoke(CreateTeamCommand $command): void
    {
        $row = $command->getRow();

        $this->neo4jClient->run(<<<'CYPHER'
MERGE(t:Team {name: $name})
MERGE(m:Manager {name: $name})
MERGE(s:Season {name: '2022-2023'})
MERGE (m)-[rm:MANAGES]->(t)
MERGE (t)-[rc:COMPETES {pl: $pl, pos: $pos, pj: $pj, goals: $goals, ass: $ass, gtp: $gtp, tp: $tp, tpint: $tpint, ta: $ta, tr: $tr, gls90: $gls90, ast90: $ast90, ga90: $ga90, gtp90: $gtp90, gatp: $gatp, xG: $xG, npxG: $npxG, xAG: $xAG, npxGxAG: $npxGxAG}]->(s)
CYPHER, [
            'name' => $row[0],
            'pl' => $row[1],
            'pos' => $row[2],
            'pj' => $row[3],
            'goals' => $row[8],
            'ass' => $row[9],
            'gtp' => $row[10],
            'tp' => $row[11],
            'tpint' => $row[12],
            'ta' => $row[13],
            'tr' => $row[14],
            'gls90' => $row[15],
            'ast90' => $row[16],
            'ga90' => $row[17],
            'gtp90' => $row[18],
            'gatp' => $row[19],
            'xG' => $row[20],
            'npxG' => $row[21],
            'xAG' => $row[22],
            'npxGxAG' => $row[23],
        ]);
    }
}
