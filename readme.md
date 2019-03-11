# API Task

[![Build Status](https://travis-ci.org/thenabeel/api-task.svg?branch=master)](https://travis-ci.org/thenabeel/api-task) 
[![StyleCI](https://github.styleci.io/repos/174709898/shield?branch=master)](https://github.styleci.io/repos/174709898)

## Installation
It requires PHP >= 7.1.3, Composer and MySQL.

Clone the folder and run Composer

```bash
composer install
```
Create database and then set these variables accordingly in `.env` file:
```bash
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
It's time to run migrations now to create required table in database:
```bash
php artisan migrate
```


## Usage

**GET /api/external-books?name=:nameOfABook**

**POST /api/v1/books**
Accepts input as form data.

**PATCH /api/v1/books/:id**
Accepts input as x-www-form-url-encoded.

**GET /api/v1/books/:id**

**DELETE /api/v1/books/:id**


## Postman Collection
To ease API testing, I am attaching Postman Collection so you can easily import and test.

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/76b0973242df861a92d1#?env%5BAdeva%20Local%5D=W3sia2V5IjoiaG9zdCIsInZhbHVlIjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwIiwiZGVzY3JpcHRpb24iOiIiLCJ0eXBlIjoidGV4dCIsImVuYWJsZWQiOnRydWV9XQ==)

If above button does not work, you can download collection from here:

[Collection Link](https://www.getpostman.com/collections/76b0973242df861a92d1)


## Tested Code
Tests have been written. Tests status:

[![Build Status](https://travis-ci.org/thenabeel/api-task.svg?branch=master)](https://travis-ci.org/thenabeel/api-task) 


## Coding Standard
PSR2 with Laravel preset

[![StyleCI](https://github.styleci.io/repos/174709898/shield?branch=master)](https://github.styleci.io/repos/174709898)