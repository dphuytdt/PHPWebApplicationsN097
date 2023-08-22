<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\CategoryService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
            $result = json_decode($response->getBody(), true);

            return view('main.book.book-details', compact('result', 'categories'));
        }
        catch (\Exception $e) {
            dd($e);
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function search(Request $request)
    {
        $client = new Client();
        $keyword = $request->input('keyword');
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 2);
        $categories = $this->categoryService->getCategory();

        try {
            $response = $client->get($this->bookService.'books/search/'.$keyword.'?page='.$page);
            $responseData  = json_decode($response->getBody(), true);

            if($responseData){
                $books = json_decode($response->getBody(), true);
                $perPage = 8;
                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $books['data'],
                    $books['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
                return view('main.home.search-result', compact('paginator', 'categories'));
            }
            else{
                $paginator = [];
                return view('main.home.search-result')->with('error', 'No result found')->with('categories', $categories)->with('paginator', $paginator);
            }
        }
        catch (\Exception $e) {
            $paginator = [];
            return view('main.home.search-result')->with('error', 'No result found')->with('categories', $categories)->with('paginator', $paginator);
        }
    }

    public function viewMore(string $dataType, Request $request)
    {
        $categories = $this->categoryService->getCategory();
        $client = new Client();

        try {
            $response = $client->get($this->bookService.'books/view-more/'.$dataType);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                $books = json_decode($response->getBody(), true);
                $perPage = 8;

                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $books['data'],
                    $books['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $paginator = [];
            }
            return view('main.book.all-books', compact('paginator', 'categories', 'dataType'));
        } catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function getBookByCategory($id, Request $request)
    {
        $categories = $this->categoryService->getCategory();

        $name = '';
        //
        foreach($categories as $category){
            if($category['id'] == $id){
                $name = $category['name'];
            }
        }
        $dataType = $name;
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'books/category/'.$id);
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                $books = json_decode($response->getBody(), true);

                $perPage = 8;

                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $books['data'],
                    $books['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $paginator = [];
            }

            return view('main.book.all-books', compact('paginator', 'categories', 'dataType'));
        } catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function category(Request $request)
    {
        $categories = $this->categoryService->getCategory();

        $client = new Client();

        try {
            $response = $client->get($this->bookService.'category/all');
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                $books = json_decode($response->getBody(), true);

                $perPage = 8;

                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $books['data'],
                    $books['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $paginator = [];
            }

            return view('main.category.index', compact('paginator', 'categories'));
        } catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

}
