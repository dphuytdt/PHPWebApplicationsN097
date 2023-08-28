<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\CategoryService;
use Illuminate\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BookController extends Controller
{
    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }
    public function bookDetails($id)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->bookService.'books/'.$id);

            if (isset(session()->get('user')['id'])) {
                $user = session()->get('user')['id'];
            } else {
                $user = -1;
            }

            $isPaymentResponse = $client->get($this->paymentService.'is-payment/'. $id .'/' . $user);
            $result = json_decode($response->getBody(), true);

            $bookId = $result['book']['id'];
            $req= $client->get($this->bookService.'books/related/'.$bookId);

            $relatedBooks = json_decode($req->getBody(), true);

            $isPayment = json_decode($isPaymentResponse->getBody(), true);

            $comments = $client->get($this->interactionService.'comment/'.$id);
            $comments = json_decode($comments->getBody(), true);
            $yourComment = null;
            foreach ($comments as $key => $value) {
                if ($value[0]['user_id'] == $user) {
                    unset($comments[$key]);
                    $yourComment = $value;
                    break;
                }
            }

            $totalRate = 0;
            foreach ($comments as $key => $value) {
                $totalRate += $value[0]['rate'];
                $totalRate = $totalRate / count($comments);
            }

            return view('main.book.book-details', compact('result', 'isPayment', 'categories', 'relatedBooks', 'comments', 'yourComment', 'totalRate'));
        }
        catch (\Exception|GuzzleException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
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

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

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
        catch (\Exception|GuzzleException $e) {
            $paginator = [];
            return view('main.home.search-result')->with('error', 'No result found')->with('categories', $categories)->with('paginator', $paginator);
        }
    }

    public function viewMore(string $dataType, Request $request)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

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
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        $name = '';

        foreach($categories as $category){
            if($category['id'] == $id){
                $name = $category['name'];
            }
        }
        $dataType = $name;
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
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->bookService.'category/all');
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                $req = $client->get($this->bookService.'books/all');

                $books = json_decode($req->getBody(), true);

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

    public function readBook($id)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            if (isset(session()->get('user')['id'])) {
                $user = session()->get('user')['id'];
            } else {
                $user = -1;
            }
            $isPaymentResponse = $client->get($this->paymentService.'is-payment/'. $id .'/' . $user);
            $res = json_decode($isPaymentResponse->getBody(), true);
        }
        catch (\Exception|GuzzleException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return view('errors.404')->with('categories', $categories);
        }

        if($res) {
            $response = $client->get($this->bookService.'books/'.$id);
            $result = json_decode($response->getBody(), true);
            return view('main.book.read-book', compact('result', 'categories'));
        }

        return view('errors.404')->with('categories', $categories);
    }

    /**
     * @throws GuzzleException
     */
    public function bookByCategory($id, Request $request)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->bookService.'category/all');
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                $req = $client->get($this->bookService.'books/all');

                $books = json_decode($req->getBody(), true);

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

    /**
     * @throws GuzzleException
     */
    public function booksByCategory($id, Request $request) {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->bookService.'category/all');
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                $req = $client->get($this->bookService.'books/category/'.$id);

                $books = json_decode($req->getBody(), true);

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
