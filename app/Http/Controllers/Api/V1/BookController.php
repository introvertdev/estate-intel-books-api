<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\BookUpdateRequest;
use Illuminate\Http\Request;
use App\Domain\Repositories\Book\BookRepository;
use App\Parser\JsonParser;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookRepository $bookRepository, JsonParser $jsonParser)
    {
        $books = $bookRepository->findAll();
        return $this->FetchSuccessResponse($books);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, BookRepository $bookRepository, JsonParser $jsonParser)
    {
        $book = $bookRepository->create($request->all());
        
        return $this->successResponse($book,null,201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->findById($id);

        return $this->successResponse($book,null,200);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id, BookRepository $bookRepository)
    {
        $book = $bookRepository->update($request->all(), $id);
        return $this->successResponse($book, "The book {$book->name} was updated successfully", 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, BookRepository $bookRepository)
    {
        $book =  $bookRepository->delete($id);
        return $this->successResponse($book, "The book '{$book->name}' was deleted successfully", 204);  
    }

    /**
     * Search for a specified resource from storage.
     *
     * @param  Request  $$request
     * @return \Illuminate\Http\Response
     */
    public function search(BookSearchRequest $request, BookRepository $bookRepository)
    {
        $externalBook = $bookRepository->search(
            $request->collect()
        );
        
        return $this->FetchSuccessResponse($externalBook);  
    }
}
