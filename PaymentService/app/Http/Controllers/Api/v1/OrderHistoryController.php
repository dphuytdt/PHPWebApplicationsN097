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

    public function isPayment(int $bookId, int $userId) {
        $result = $this->orderHistoryRepository->isPayment($userId, $bookId);
        return response()->json([
            'status' => 'success',
            'message' => 'Payment successfully',
            'data' => $result,
            'statusCode' => 200
        ], 200);
    }
}
