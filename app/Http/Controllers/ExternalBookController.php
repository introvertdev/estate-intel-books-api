<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Services\External\BookService;

class ExternalBookController extends Controller
{

    public function externalSearch(Request $request,  BookService $bookService)
    {
        $externalBook = $bookService->searchBooks(
            $request->get('name')
        );
        return $this->externalFetchSuccessResponse($externalBook, null, 200);  
         
    }
}