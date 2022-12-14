# Liga MX | CSV Importer
This is an academic project that uses Laravel and Neo4J to import statistics from the main soccer league in Mexico (_Liga MX_) and stores into a graph database using a Neo4J driver. After running the importer, you will get a populated graph database with the statistics of players, teams and coaches in _Liga Mx_. From this point, is up to you how to use this database. If you found this helpful in any way, please reach out to me and tell me your experience at [@kemankahn](https://twitter.com/KemanKahn).

## Introduction

I created this project to help accelerate the process to analyze statistics of the main soccer league in Mexico. I noticed people was struggling to run complex queries in relational databases but didn't want to design and populate a NoSQL database. Therefore, I decided to help and create an importer that can set up a graph database with the statistics of players, teams and coaches in _Liga MX_ so they can focus on analyzing the data.

I'm taking the statistics from the following website: https://fbref.com/. This website keeps track of all the statistics from all the main soccer leagues in the world. For _Liga MX_, you can find all the statistics [here](https://fbref.com/es/comps/31/stats/Estadisticas-de-Liga-MX#all_stats_standard). You should see two tables like these:

_Teams_:
![image-1](https://soccer-project-images-readme.s3.us-west-2.amazonaws.com/image-1.png)

_Players_:
![image-2](https://soccer-project-images-readme.s3.us-west-2.amazonaws.com/image-1.png)

These are the tables I'm importing into the graph database and these are the csv files you can export from the website:

- [Teams CSV](https://soccer-csv-files.s3.us-west-2.amazonaws.com/all_teams.csv) (Image 1)
- [Players CSV](https://soccer-csv-files.s3.us-west-2.amazonaws.com/all_players.csv) (Image 2)

If you want to take a look at the information, please click on the links above and download the csv files.

## Installation

**Prerequisites**

- PHP ^8.0
- AWS Credentials (such as access key, access secret, etc.)
- Neo4j Desktop


### Graph database design

The model of the graph database consists of 5 nodes and 5 relationships. Each one of them contain the information of every player, team and coach.

<img src="https://soccer-project-images-readme.s3.us-west-2.amazonaws.com/image-3.png" alt="image-3" style="display: block;margin-left: auto;margin-right: auto;width: 50%;">

The data imported from the csv file will be stored into a graph database following the model above.

### Neo4J Configuration
Download and install [Neo4J for Desktop](https://neo4j.com/download/). You can follow
a tutorial from their official website [here](https://neo4j.com/developer/neo4j-desktop/). Then,
set up a database. Remember the credentials because we will need them later.

**NOTE:**  By default, Neo4J creates a database called `neo4j` and it's the only one that supports `bolt` connections. If you create another database, you **WON'T** be able to integrate it locally with Laravel.

### AWS Credentials

Get your AWS credentials by loggin in to your aws console. If you have any questions, please read the [documentation](https://docs.aws.amazon.com/general/latest/gr/aws-sec-cred-types.html.) from AWS on the subject. 
You need to get your credentials because that's how you'll access the csv files stored in S3. 

**NOTE:** Make sure the user you'll use has permissions to access s3 buckets.

### Set up the project
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
- Please set the `AWS_DEFAULT_REGION` as `us-west-2` and `AWS_USE_PATH_STYLE_ENDPOINT` as `true`. Finally, set the name of the bucket as `soccer-csv-files`.
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

## Run the importer

To run the importer, please execute the following command from the root of the repository:

```bash
php artisan db:import
```

If you get any errors, please make sure your credentials are correct and try again. If you still have issues, please contact me at [@kemankahn](https://twitter.com/KemanKahn) or create an issue in the repository.

After running the importer, go to Neo4J Desktop and open the `neo4j` database. Then, run the following query:

```
MATCH (n) return (n)
```

You should see a populated graph database like this:

![image-4](https://soccer-project-images-readme.s3.us-west-2.amazonaws.com/image-4.png)

Now, everything is ready to start running queries.

## Improvements

The importer can be improved in the following areas:

- Validate data inside the csv file while performing the import
- Configure github actions
- Add unit tests

These improvements will be completed in a couple months but I don't have any due dates since this is a side project and I don't have too much time to work on it.
