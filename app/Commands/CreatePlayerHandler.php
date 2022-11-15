<?php declare(strict_types=1);

namespace App\Commands;

use Laudis\Neo4j\Contracts\ClientInterface;

class CreatePlayerHandler
{
    private ClientInterface $neo4jClient;

    public function __construct(ClientInterface $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    public function __invoke(CreatePlayerCommand $command): void
    {
        $row = $command->getRow();

        // @TODO: create a national team
        $this->neo4jClient->run(<<<'CYPHER'
MERGE(t:Team {name: $team_name})
MERGE(p:Player {name: $name})
SET p.country = $country
SET p.position = $position
SET p.age = $age
SET p.year_of_birth = $year_of_birth
MERGE(s:Season {name: '2022-2023'})
MERGE (p)-[rp:PLAYS_FOR]->(t)
MERGE (p)-[rpl:PLAYED_IN {pj: $pj, ptitu: $ptitu, pmin: $pmin, p90s: $p90s, goals: $goals, ass: $ass, gtp: $gtp, tp: $tp, tpint: $tpint, ta: $ta, tr: $tr, gls90: $gls90, ast90: $ast90, ga90: $ga90, gtp90: $gtp90, gatp: $gatp, xG: $xG, npxG: $npxG, xAG: $xAG, npxGxAG: $npxGxAG}]->(s)
CYPHER, [
            'name' => $row[1],
            'country' => $row[2] ?? 'MEX',
            'position' => $row[3],
            'team_name' => $row[4],
            'age' => $row[5] ?? 0,
            'year_of_birth' => $row[6] ?? 0,
            'pj' => $row[7] ?? 0,
            'ptitu' => $row[8] ?? 0,
            'pmin' => $row[9] ?? 0,
            'p90s' => $row[10] ?? 0,
            'goals' => $row[11] ?? 0,
            'ass' => $row[12] ?? 0,
            'gtp' => $row[13] ?? 0,
            'tp' => $row[14] ?? 0,
            'tpint' => $row[15] ?? 0,
            'ta' => $row[16] ?? 0,
            'tr' => $row[17] ?? 0,
            'gls90' => $row[18] ?? 0,
            'ast90' => $row[19] ?? 0,
            'ga90' => $row[20] ?? 0,
            'gtp90' => $row[21] ?? 0,
            'gatp' => $row[22] ?? 0,
            'xG' => $row[23] ?? 0,
            'npxG' => $row[24] ?? 0,
            'xAG' => $row[25] ?? 0,
            'npxGxAG' => $row[26] ?? 0,
        ]);
    }
}
