# CSV Importer
This is an academic project that Uses Laravel and Neo4J to import statistics from the main soccer league in Mexico (Liga MX) and store it in a graph database managed with Neo4J.

## Introduction

The main purpose of the project is to create an import tool that can...

The main purpose of the project is to create a visual interface where anyone can see statistics of the latest season in _Liga Mx. All statistics about the games, players, managers, etc. will be imported from a csv file and stored in a graph database using Neo4j. It's important to mention
that even though there are a couple open source projects available to integrate neo4j with Eloquent, we decided to use 
a custom implementation of the [neo4j-php-client](https://github.com/neo4j-php/neo4j-php-client) because we don't need to perform any complex queries and at this moment, all open source projects are not reliable. As neo4j mentions in their website: 
> The community drivers have been graciously contributed by the Neo4j community. Many of them are fully featured and well-maintained, but some may not be. Neo4j does not take any responsibility for their usability. 

Therefore, a custom implementation was used for the project.

## Installation

**Prerequisites**

- PHP ^8.0
- AWS Credentials (such as access key, access secret, etc.)
- Neo4j Desktop

To get started, first you need to download and install [Neo4J for Desktop](https://neo4j.com/download/). You can follow
a tutorial from their official website [here](https://neo4j.com/developer/neo4j-desktop/). After setting up neo4j locally
now we can start to install the project and perform actions.

To set up the project, please take the following steps:

- Clone the repository in your local machine.
- Run `composer install` in the root of the repository.
- Run `cp .env.example .env` in the root of the repository.
- Copy and paste your aws credentials in the `.env` file. Example:
```dotenv
AWS_ACCESS_KEY_ID=my-access_key_id
AWS_SECRET_ACCESS_KEY=my_secret_access_key
AWS_DEFAULT_REGION=us-west-2
AWS_BUCKET=my-bucket_name
AWS_USE_PATH_STYLE_ENDPOINT=false
```
- Please keep the `AWS_DEFAULT_REGION` and `AWS_USE_PATH_STYLE_ENDPOINT` values as in the example and talk to an administrator to provide you the `AWS_BUCKET` value.
- Now that AWS S3 has been configured, you need to set up the connection between the application and neo4j. In order to do this, you need to update the `.env` file again and copy and paste the credentials you created for your neo4j database locally. Example:
```dotenv
NEO4J_HOST=localhost
NEO4J_PORT=7687
NEO4J_DATABASE=neo4j
NEO4J_USERNAME=my-username
NEO4J_PASSWORD=my-password
NEO4J_USE_SSL=false
```
- Please keep the db name as `neo4j` since this is the default DB used by `Neo4J Desktop`.
- Finally, run `php artisan db:import` from the root of the repository. This will run a command that imports the data from csv files into the graph database.
- Enjoy playing around with the database.

## Disclaimer
The analysis and queries performed in this project are intended to serve as practice for future researches or projects involving graph databases and UI visualizations using Javascript.
