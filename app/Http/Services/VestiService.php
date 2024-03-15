<?php

namespace App\Http\Services;

use App\Classes\BaseServiceResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VestiService extends BaseService
{

    public function createProduct(array $data, int $companyId)
    {
        $url = 'https://integracao-hml.meuvesti.com/api/v1/products/company/'. $companyId;

        $token = ENV('VESTI_TOKEN');

        $response = Http::withToken($token)
            ->post($url, $data);

        if ($response->failed()) {
            return $this->error([$response->json()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);        
        }

        return $this->success([$response->json()], JsonResponse::HTTP_OK);
    }

    public function getProduct(int $companyId)
    {

        $url = 'https://integracao-hml.meuvesti.com/api/v2/products/company/' . $companyId;

        $token = ENV('VESTI_TOKEN');

        $response = Http::withToken($token)
            ->get($url);

        if ($response->failed()) {
            return $this->error([$response->json()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);        }

        return $this->success([$response->json()], JsonResponse::HTTP_OK);

    }
}
