<?php

namespace App\Domain\Repositories\Book;

use App\Models\Book;

class BookRepository
{
    protected $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function create(array $data)
    {
        return $this->bookModel->create([
            'name' => $data['name'],
            'isbn' => $data['isbn'],
            'authors' => is_array($data['authors']) ? serialize($data['authors']) : serialize([$data['authors']]),
            'country' => $data['country'],
            'number_of_pages' => $data['number_of_pages'],
            'publisher' => $data['publisher'],
            'release_date' => $data['release_date'],
        ]);
    }

    public function update(array $data, $id)
    {
        
        if(array_key_exists('authors', $data)){
            $authors = is_array($data['authors']) ? serialize($data['authors']) : serialize([$data['authors']]);
            $data['authors'] = $authors;
        }
        
        $this->bookModel->where('id', $id)
            ->update($data);

        return $this->findById($id);
    }

    public function findById($id)
    {
        return $this->bookModel->findOrFail($id);
    }

    public function findAll()
    {
       return $this->bookModel->all();   
    }

    public function delete($id)
    {
        $book = $this->findById($id);
        $this->bookModel->where('id', $id)->delete();
        return $book;
    }

    public function search($query)
    {
        if(is_null($query)){
            $books = $this->bookModel->findAll();
        } 

        if($query->has('name') ) {
            $name = $query->get('name');
            $books = $this->bookModel->where("name", "LIKE", "%$name%")->get();
        }

        if($query->has('country') ) {
            $country = $query->get('country');
            $books = $this->bookModel->where("country", "LIKE", "%$country%")->get();
        }

        if($query->has('publisher') ) {
            $publisher = $query->get('publisher');
            $books = $this->bookModel->where("publisher", "LIKE", "%$publisher%")->get();
        }

        if($query->has('release_date') ) {
            $release_date = $query->get('release_date');
            $books = $this->bookModel->where("release_date", "LIKE", "%$release_date%")->get();
        }

        return $books;
    }
}
