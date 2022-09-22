## Estate Intel Book API Assesment



This is a short coding assessment which implements a REST API that calls an external API service to get information about books as well as CREATE, READ, UPDATE and DELETE books locally applying more often implementing the SRP - S of the SOLID design pronciples.

## Installation

- Ensure you have php installed on your machine or you are using XAMPP Apache server which comes with PHP by default
- Ensure you have composer installed on your machine as well (composer in a php dependency manager just like npm in Node )

Clone the repository `git clone https://github.com/introvertdev/estate-intel-books-api.git`

After cloning, 
    
    cd estate-intel-book-api-v1
    
After that 
    run this command to install all dependencies `composer install` 
    
## Setup 
We need to setup up a database but for us to do that we have to create a `.env` file.
Git ignores this file when files are pushed to github, so to create it 

run this comman in your terminal `cp .env.example .env`

This command will create a .env file and copy the content of .env.example to it.

**Alternatively**

You can manually create a `.env` file in the root directory and copy the content of `.env.example` into it.

## Create database
Create your database and fill in the correct details in the `.env file`
Open `.env file` that you just created and locate the `DB_CONNECTION` section of the code and update the CONNECTION DETAILS as neccessary
    
run `php artisan migrate` to migrate your database.

run `php artisan serve` to start the application.

Run tests by runnning `php artisan test`

#### Endpoints
```
BASE URL = http://localhost:8000/api
OR

BASE URL = http://127.0.0.1:8000/api
```
1. query the Ice And Fire API for books

```
GET: '/external-books'
```

2. Search the Ice And Fire API for a book by name

```
GET: '/external-books?name=A Game of Thrones'
```

3. Create a book

```
POST: '/v1/books'
```

|   |  required |  description | data type |
|---|---|---|---|
|  name | yes  |  title of book  | String |
|  isbn | yes  |  isbn of book  | String |
|  authors | yes  |  authors of book seperated by comma (,). eg 'Jan Doe', 'John Doe' | String |
|  publisher |  yes |  publisher of book  | String |
|  number_of_pages | yes  | number of pages the book contains  | Integer |
|  country | yes  |  country of origin | String |
|  released_date | yes  | date released  |  date |


- RESPONSE
```
{
    "status_code": 201,
    "status": "success",
    "data": {
        "book": {
            "name": "The Avalance",
            "isbn": "122-221233",
            "authors": [
                "Tobi Emman"
            ],
            "publisher": "Kenedy",
            "country": "Nigeria",
            "release_date": "2009-05-04",
            "number_of_pages": 300,
            "id": 1
        }
    }
}
```
4. List all books

```
GET: '/v1/books'
```

- RESPONSE
```
{
    "status_code": 200,
    "status": "success",
    "data": []
    
}
```

5. Show a book

```
GET: '/v1/books/{bookId}'
```
- RESPONSE
```
{
    "status_code": 201,
    "status": "success",
    "data": {
        "book": {
            "name": "Sanni T Z.",
            "isbn": "23638-3373",
            "authors": [
                "Emman Rowler"
            ],
            "publisher": "Habib",
            "country": "Cotonou",
            "release_date": "2010-05-03",
            "number_of_pages": 800,
            "id": 1
        }
    }
}
```

6. Update a book

```
PATCH: '/v1/books/{bookId}'
```

DATA

```
{
    "name": "Charisma of A Developer"
}
```

- RESPONSE
```
{
    "status_code": 200,
    "status": "success",
    "message": "The book 'Charisma of A Developer' was updated successfully"
    "data": []
    
}
```

7. Delete a book
```
DELETE: '/v1/books/{bookId}'
```
- RESPONSE
```
{
    "status_code": 200,
    "status": "success",
    "message": "The book Charisma of A Developer was deleted successfully"
    "data": []
    
}
```

8. Search for a book
```
Search a book by name, country , publisher and release date (year). You can substitute the first query param with country, publisher etc. E.g 'publisher=Emman'.
```

```
GET: '/v1/books/search?name=Charisma of A Developer'
```

- RESPONSE
```
{
    "status_code": 200,
    "status": "success",
    "data": []    
}
```
