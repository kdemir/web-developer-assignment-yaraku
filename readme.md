This is a simple web application to add, edit, delete and update Books. Some extra features include: searching for books by Author or Title, Sort by Author or Title and CSV and XML Export.

How to run this project:
- Start the containers by running 'docker-compose up -d' in the project root
- Install the composer packages by running 'docker-compose exec laravel composer install'
- ensure that the containers and mysql database are running with docker ps -a
- access the Books view with http://localhost/books
  
Tests
- to run the unittests use the command vendor/bin/phpunit
- the Test environment uses a memory database. Therefore the data from the local database won't be deleted.
  
Database
- if the Laravel User gets the 'SQLSTATE[HY000][2054] The server requested authentication method unknown to the client' Exception, please run this script in your database:
  ALTER USER 'laravel'@"%" IDENTIFIED WITH mysql_native_password BY 'secret';
  GRANT ALL PRIVILEGES ON *.* TO 'laravel'@"%" WITH GRANT OPTION;


## Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)

## Setup
1. Clone the repository.
1. Start the containers by running `docker-compose up -d` in the project root.
1. Install the composer packages by running `docker-compose exec laravel composer install`.
1. Access the Laravel instance on `http://localhost` (If there is a "Permission denied" error, run `docker-compose exec laravel chown -R www-data storage`).

Note that the changes you make to local files will be automatically reflected in the container. 

## Persistent database
If you want to make sure that the data in the database persists even if the database container is deleted, add a file named `docker-compose.override.yml` in the project root with the following contents.
```
version: "3.7"

services:
  mysql:
    volumes:
    - mysql:/var/lib/mysql

volumes:
  mysql:
```
Then run the following.
```
docker-compose stop \
  && docker-compose rm -f mysql \
  && docker-compose up -d
``` 
