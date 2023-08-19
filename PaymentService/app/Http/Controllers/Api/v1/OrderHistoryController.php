<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderHistoryRepositoryInterface;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    private OrderHistoryRepositoryInterface $orderHistoryRepository;

    public function __construct(OrderHistoryRepositoryInterface $orderHistoryRepository)
    {
        $this->orderHistoryRepository = $orderHistoryRepository;
    }

    public function getOrderHistory($userID)
    {
        $orderHistory = $this->orderHistoryRepository->getOrderHistory($userID);
        return response()->json(['orderHistory' => $orderHistory], 200);
    }
}
