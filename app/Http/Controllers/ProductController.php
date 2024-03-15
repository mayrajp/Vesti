<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\VestiService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private VestiService $vestiService;

    public function __construct()
    {
        $this->vestiService = new VestiService();
    }

    public function index(int $companyId){

        $response = $this->vestiService->getProduct($companyId);

        return response()->json($response->data, $response->code);

        
    }

    public function store(ProductRequest $request, int $companyId){

        $data = $request->all();

        $response = $this->vestiService->createProduct($data, $companyId);

        return response()->json($response->data, $response->code);
    }
}
