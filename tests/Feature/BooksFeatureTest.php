<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;

class BooksFeatureTest extends TestCase
{
    /**
     * @test
     */
    public function create_book()
    {

        $data = Book::factory(Book::class)->raw();
        
        $response = $this->post('/api/v1/books', $data);

        $results = json_decode($response->getContent());

        $response->assertStatus(201);

        $this->assertEquals($results->status_code, 201);
        $this->assertEquals($results->status, 'success');
        $this->assertObjectHasAttribute('book', $results->data);
        $this->assertObjectHasAttribute('data', $results);
        $this->assertIsArray($results->data->book->authors);
    }

    /**
     * @test
     */
    public function get_books()
    {
        Book::factory(Book::class)->create();

        $response = $this->get('/api/v1/books');
        $results = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertEquals($results->status_code, 200);
        $this->assertEquals($results->status, 'success');
        $this->assertObjectHasAttribute('data', $results);
    }

    /**
     * @test
     */
    public function get_a_book()
    {
        $book = Book::factory(Book::class)->create();
        $response = $this->get('/api/v1/books/'.$book->id);

        $results = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertEquals($results->status_code, 200);
        $this->assertEquals($results->status, 'success');
        $this->assertObjectHasAttribute('data', $results);
        $this->assertEquals($book->id, $results->data->id);

    }

    /**
     * @test
     */
    public function update_a_book()
    {
        $book = Book::factory(Book::class)->create();


        $response = $this->patch('/api/v1/books/'.$book->id, [
            'name' => 'Intergalactic Avenger'
        ]);


        $results = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertEquals($results->status_code, 200);
        $this->assertEquals($results->status, 'success');
        $this->assertObjectHasAttribute('message', $results);
        $this->assertEquals($results->message, "The book {$results->data->name} was updated successfully");
    }

    /**
     * @test
     */
    public function delete_a_book()
    {
        $book = Book::factory(Book::class)->create();

        $response = $this->delete('/api/v1/books/'.$book->id);

        $results = json_decode($response->getContent());

        $response->assertStatus(200);

        $this->assertEquals($results->status_code, 204);
        $this->assertEquals($results->status, 'success');
    }

    /**
     * @test
     */
    public function search_for_books()
    {
        $book = Book::factory(Book::class)->create()->first();

        $response = $this->get("/api/v1/books/search?name={$book->name}");

        $results = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertEquals($results->status_code, 200);
        $this->assertEquals($results->status, 'success');
        $this->assertEquals($results->data[0]->name, $book->name);
    }

    /**
     * @test
     */
    public function get_external_books()
    {
        $response = $this->get('/api/external-books');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_an_external_book()
    {
        $response = $this->get('/api/external-books?name=A Game of thrones');

        $response->assertStatus(200);
    }

     /**
     * @test
     */
     public function get_a_non_existing_book()
     {
        $response = $this->get('/api/v1/books/999');
 
        $response->assertStatus(404);

        $results = json_decode($response->getContent());

        $this->assertEmpty($results->data);
     }
}
