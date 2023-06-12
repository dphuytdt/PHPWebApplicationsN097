<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index(Request $request)
    {
        // dd($request);
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'category/admin');
            $categories = json_decode($response->getBody(), true);
            $perPage = 4;

            // Số trang hiện tại, lấy từ query string hoặc mặc định là 1
            $currentPage = $request->query('page', 2);
            // dd ($categories);

            // Tạo một LengthAwarePaginator từ kết quả sách và các thông số phân trang
            $paginator = new LengthAwarePaginator(
                $categories['data'],   // Dữ liệu sách
                $categories['total'],  // Tổng số sách
                $perPage,         // Số lượng sách trên mỗi trang
                $currentPage,     // Trang hiện tại
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return view('home.category.list', compact('paginator'));
        } catch (\Exception $e) {
            dd($e);
            // return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
