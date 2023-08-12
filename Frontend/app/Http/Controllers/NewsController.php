<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getCategory();
        $client = new Client();

        try{
            $response = $client->request('GET', 'http://contentmanagementservice.test:8080/api/user/news');
            $data = json_decode($response->getBody()->getContents());
            $articles = $data->articles;

            if($articles) {
                $news = json_decode($response->getBody(), true);
                // Số lượng sách hiển thị trên mỗi trang
                $perPage = 8;

                // Số trang hiện tại, lấy từ query string hoặc mặc định là 1
                $currentPage = $request->query('page', 1);

                // Tạo một LengthAwarePaginator từ kết quả sách và các thông số phân trang

                $paginator = new LengthAwarePaginator(
                    $news['data'],   // Dữ liệu sách
                    $news['total'],  // Tổng số sách
                    $perPage,         // Số lượng sách trên mỗi trang
                    $currentPage,     // Trang hiện tại
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        } catch(\Exception|GuzzleException $e) {
            $articles = [];
        }
        return view('main.news.index')->with('articles', $articles)->with('categories', $categories);
    }

    public function show()
    {
        return view('main.news.show');
    }
}
