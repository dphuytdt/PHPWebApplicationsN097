<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\CategoryService;
class BookController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function bookDetails($id)
    {
        $categories = $this->categoryService->getCategory();
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'books/'.$id);
            $book = json_decode($response->getBody(), true);
            return view('main.book-details', compact('book', 'categories'));
        } 
        catch (\Exception $e) {
            return redirect()->intended('/')->with('error', 'Login failed');
        }
    }

    public function search(Request $request)
    {
        $client = new Client();
        $categories = $this->categoryService->getCategory();
        //call to book service to get book by id
        try {
            $response = $client->get($this->bookService.'books/search/'.$request->keyword);
            $books = json_decode($response->getBody(), true);
            //paginate books
            if($books){
                $paginate = 5;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offSet = ($page * $paginate) - $paginate;
                $itemsForCurrentPage = array_slice($books, $offSet, $paginate, true);
                $books = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($books), $paginate, $page);
                $books->setPath(request()->url());
                return view('main.search-result', compact('books', 'categories'));
            }
            else{
                return redirect()->intended('/')->with('error', 'No result')->withInput()->with('categories', $categories);
            }
        } 
        catch (\Exception $e) {
            return redirect()->intended('/')->with('error', 'Error', 'categories', $categories);
        }
    }

    public function allBook(Request $request){
        $currentPage = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        
        $http = new Client(
            [
                'base_uri' => $this->bookService,
                'timeout' => 2.0,
            ]
        );

        $response = $http->request('GET', 'books', [
            'query' => [
                'page' => $currentPage,
                'perPage' => $perPage,
            ]
        ]);

        $books = json_decode($response->getBody(), true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $books['data'],
            $books['total'],
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );

        // return view('main.all-book', compact('paginator'));
    }

}
