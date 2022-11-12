# Liga MX Analysis
This is an academic project that uses Laravel alongside Neo4J to perform analysis on the main soccer league in Mexico: Liga MX.

## Introduction
The main purpose of the project is to create a visual interface where anyone can see statistics of the latest season in _Liga Mx. All statistics about the games, players, managers, etc. will be imported from a csv file and stored in a graph database using Neo4j. It's important to mention
that even though there are a couple open source projects available to integrate neo4j with Eloquent, we decided to use 
a custom implementation of the [neo4j-php-client](https://github.com/neo4j-php/neo4j-php-client) because we don't need to perform any complex queries and at this moment, all open source projects are not reliable. As neo4j mentions in their website: 
> The community drivers have been graciously contributed by the Neo4j community. Many of them are fully featured and well-maintained, but some may not be. Neo4j does not take any responsibility for their usability. 

Therefore, a custom implementation was used for the project.

## To Consider
The analysis and queries performed in this project are intended to serve as practice for future researches or projects involving graph databases and UI visualizations using Javascript.
