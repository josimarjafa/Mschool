# Mschool in PHP by Josimar Andrade for Lexia Learning

Using a programming language of your choice, spend 1-2 hours writing an application 
to get and store Massachusetts school ranking data from https://www.schooldigger.com

NOTE: All the development was made on Ubuntu 18.04.3 LTS x86_64


* Requirements
	Written in Java, PHP, Python
		To fill the gap, I chose PHP because there is have 5.8% less user in comparision with Java 14.1% and Python 14.7%,
		According "Ranking Programming Languages by GitHub Users" (https://www.benfrederickson.com/ranking-programming-languages-by-github-users/)
	To get and store Massachusetts school ranking data from https://www.schooldigger.com
		
		Store a school’s id and name, and any other data you think is useful

		Store rankings from the past 5 years
	
	If you don’t have time to implement and save to a database
		Solution will be using an embedded Database 
		(It is possible to create both in-memory tables, as well as disk-based tables)


## Diagrams
```
* Workflow

	iniciar -> Setup the database (Creat table if not exite) -> make the school request / ranking request -> save to the db -> print statistics -> end

	+-----------+        +-------------+       +--------------+        +---------------+       +---------------+       +--------------+
	|           |        |  Setup the  |       | Make school  |        | Make rankings |       |     Print     |       |              |
	|   Start   +------->+  database   +------>+ requests     +------->+ requests     +------>+  statistics   +------>+     END       |
	|           |        |     (1)     |       |              |        |               |       |               |       |              |
	+-----------+        +-------------+       +-------+---+--+        +--+---+--------+       +---------------+       +--------------+
		                                           |   ^              |   ^
		                                           v   |              v   |
		                                        +--+---+--------------+---+---+
		                                        | https://api.schooldigger.com|
		                                        |                             |
		                                        |                             |
		                                        +-----------------------------+
```

		(1): Setup the database (Creat table if not exist)

* System Architecture
```

	+--------------------------------------+                             +------------------+
	|         Mschool Application          |                             | SchoolDigger.com |
	|                                      |        RestFul (HTTP)       |                  |
	|      +-------------------+           +---------------------------->+                  |
	|      |                   |           |                             |                  |
	|      |                   |           |                             |                  |
	|      |    Restful        |           |                             |                  |
	|      |  application      |           |                             |                  |
	|      |                   |           |                             |                  |
	|      |                   |           |                             |                  |
	|      |          +--------+--+        |                             +------------------+
	|      |          |           |        |
	|      |          |           |        |
	|      |          |  Embed    |        |
	|      |          | Database  |        |
	|      |          |           |        |
	|      |          |           |        |
	|      |          |           |        |
	|      +----------+           |        |
	|                 +-----------+        |
	|                                      |
	|                                      |
	+--------------------------------------+

```
### Database
```
                    school
    +----------------------------+-------------+------+-----+---------+-------+
    |           Field            |    Type     | Null | Key | Default | Extra |
    +----------------------------+-------------+------+-----+---------+-------+
    | schoolid                   | int(11)     | NO   | PRI | NULL    |       |
    | school_name                | varchar(31) | YES  |     | NULL    |       |
    | phone                      | varchar(14) | YES  |     | NULL    |       |
    | address_lat_long_latitude  | float       | YES  |     | NULL    |       |
    | address_lat_long_longitude | float       | YES  |     | NULL    |       |
    | address_street             | varchar(15) | YES  |     | NULL    |       |
    | address_city               | varchar(11) | YES  |     | NULL    |       |
    | address_zip                | int(11)     | YES  |     | NULL    |       |
    | low_grade                  | int(11)     | YES  |     | NULL    |       |
    | high_grade                 | int(11)     | YES  |     | NULL    |       |
    | is_virtual_school          | varchar(2)  | YES  |     | NULL    |       |
    | rank_history_year          | int(11)     | YES  |     | NULL    |       |
    | rank_history_rank          | int(11)     | YES  |     | NULL    |       |
    | rank_history_rank_of       | int(11)     | YES  |     | NULL    |       |
    | rank_history_rank_stars    | int(11)     | YES  |     | NULL    |       |
    | rank_history_rank_level    | varchar(6)  | YES  |     | NULL    |       |
    | rank_movement              | int(11)     | YES  |     | NULL    |       |
    +----------------------------+-------------+------+-----+---------+-------+

                rank
    +------------+------------+------+-----+---------+-------+
    |   Field    |    Type    | Null | Key | Default | Extra |
    +------------+------------+------+-----+---------+-------+
    | schoolid   | int(11)    | NO   | PRI | NULL    |       |
    | year       | int(11)    | YES  |     | NULL    |       |
    | rank       | int(11)    | YES  |     | NULL    |       |
    | rank_of    | int(11)    | YES  |     | NULL    |       |
    | rank_stars | int(11)    | YES  |     | NULL    |       |
    | rank_level | varchar(6) | YES  |     | NULL    |       |
    +------------+------------+------+-----+---------+-------+

```

## File directory
```
    Mschool/
    ├── CHALLENGE               --> challenge document
    ├── composer.json           --> Composer dependencies and configurations
    ├── composer.lock           --> Last composer dependencies and configurations
    ├── database.db             --> The database, ill will be create automatic
    ├── database_schema.sql     --> The database schema
    ├── log.log                 --> Application log
    ├── main_faster.php         --> Main application, the faster result (retrieving just one page)
    ├── main.php                --> Main application
    ├── README.txt              --> This document
    ├── src
    │   ├── ActiveRecord.php    -->  SQL query's fro models
    │   ├── App.php             -->  Application configurations and resources
    │   ├── Database.php        -->  Database interface
    │   └── School.php          -->  Data module, not just for school
    └── vendor                  -->  Third party extensions
```
## usage

    install dependences (if Third party extensions is missing):
        composer install
    run:
        php main.php
        php main_faster.php   (faster result retrieving just one page)


## License
Copyright (c) 2019. Josimar Andrade, No Rights Reserved
