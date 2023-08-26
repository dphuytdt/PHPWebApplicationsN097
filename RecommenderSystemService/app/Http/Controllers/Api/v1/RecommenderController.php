<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Recommender\ProductSimilarity;
use Exception;
use Illuminate\Http\Request;

class RecommenderController extends Controller
{
    /**
     * @throws Exception
     */
    public function getSimilarities(Request $request): \Illuminate\Http\JsonResponse
    {
        $products        = json_decode(file_get_contents(storage_path($request->input('file'))));
        $selectedId      = intval(app('request')->input('id') ?? '8');
        $selectedProduct = $products[0];

        $selectedProducts = array_filter($products, function ($product) use ($selectedId) { return $product->id === $selectedId; });
        if (count($selectedProducts)) {
            $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
        }

        $productSimilarity = new ProductSimilarity($products);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $products          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);

        return response()->json([
            'selected_product' => $selectedProduct,
            'products'         => $products,
        ]);
    }
}
