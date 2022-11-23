## Table of contents
* [General informations](#general-informations)
* [Technologies](#technologies)
* [Setup](#setup)

## General informations
This project is Api application with JWT authentication. It uses PHP framework - Symfony for backend. User can create an account, login and get token and refresh token (they need to be stored eg. in cookies), with token user can acces /api endpoint, logout or use refresh token to refresh expired token. All endpoints with required headers/body are available at /api/doc. Use Postman application to run this project.
## Technologies
Project is created with:
* PHP 
* Symfony 

used bundles:
* doctrine - to communicate controllers with database
* LexikJWTAuthenticationBundle - to handle JWT
* JWTRefreshTokenBundle - to handle refresh token
* NelmioApiDocBundle - to make api documentation


## Setup
To run this project, install locally using composer: 

```
$ composer install
$ docker-compose up -d
$ symfony serve -d
$ symfony console lexik:jwt:generate-keypair
$ symfony console make:migration
$ symfony console doctrine:migrations:migrate
```

To check documentation go to:
```
https://localhost:8000/api/doc
```

To run all endpoints use:

```
https://www.postman.com/
```