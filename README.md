# Orion Test Center 

## Prerequisites

Have PHP, Apache and MySQL DataBase installed.

## Getting Started

Clone the project 

```
$ git clone https://github.com/amandasrosa/orion.git
```

Copy the project folder to the Apache htdocs folder:

```
$ cp <where-you-cloned>/orion <apache>/htdocs
```

Get the database in `/orion/database` scripts and execute them in the following order:
1. `orion.sql` # Table structures
2. `initial-data.sql` # Subjects and Questions
3. `sample.sql` # Sample rows. It is not required

Given that database is created, MySQL and Apache is running just open the browser at the url http://localhost/orion/

Test Users:
* Admin - username: denis / password: brazil
* User - username: user / password: user

## Built With

* HTML 5
* CSS 3
* JavaScript
* PHP 7.1.7
* Apache 2.4.28
* MySQL 5.6.36-82.2

## Team name
* **Orion**

## Authors 
* **Araceli Teixeira** 
* **Amanda Rosa**
* **Denis Gois**

