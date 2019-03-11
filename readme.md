# API Task

[![Build Status](https://travis-ci.org/thenabeel/api-task.svg?branch=master)](https://travis-ci.org/thenabeel/api-task) 
[![StyleCI](https://github.styleci.io/repos/174709898/shield?branch=master)](https://github.styleci.io/repos/174709898)


## Live Server
For your ease, code is deployed on live server API can be accessed without local installation:

http://172.104.135.245/


## Postman Collection
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/76b0973242df861a92d1#?env%5BAdeva%20Local%5D=W3sia2V5IjoiaG9zdCIsInZhbHVlIjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwIiwiZGVzY3JpcHRpb24iOiIiLCJ0eXBlIjoidGV4dCIsImVuYWJsZWQiOnRydWV9XQ==)

Above live server can be used as host.

If above button does not work, you can download collection from here:

[Collection Link](https://www.getpostman.com/collections/76b0973242df861a92d1)


## Usage

**GET /api/external-books?name=:nameOfABook**

*Filters (can be passed as parameter):*
<br />filter[name]
<br />filter[country]
<br />filter[publisher]
<br />filter[release_year]

**POST /api/v1/books**
Accepts input as form data.

**PATCH /api/v1/books/:id**
Accepts input as x-www-form-url-encoded.

**GET /api/v1/books/:id**

**DELETE /api/v1/books/:id**


## Local Installation
Laravel Framework has been used.
It requires PHP >= 7.1.3, Composer and MySQL.
Also, see Laravel Installation docs.

Clone the folder and run Composer

```bash
composer install
```
Copy `.env.example` to `.env` if it does not exist.
Create database and then set these variables accordingly in `.env` file:
```bash
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Create `APP_KEY` if it does not already exist in `.env` file.
```bash
php artisan key:generate
```

It's time to run migrations now to create required table in database:
```bash
php artisan migrate
```


## Tested Code
Tests have been written. Tests status:

[![Build Status](https://travis-ci.org/thenabeel/api-task.svg?branch=master)](https://travis-ci.org/thenabeel/api-task) 


## Coding Standard
PSR2 with Laravel preset

[![StyleCI](https://github.styleci.io/repos/174709898/shield?branch=master)](https://github.styleci.io/repos/174709898)