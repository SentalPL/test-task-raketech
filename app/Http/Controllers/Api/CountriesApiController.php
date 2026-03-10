<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Interfaces\CountriesRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CountriesApiController
{
    public function __construct(
        protected CountriesRepositoryInterface $countriesRepository
    )
    {
    }

    public function all(): JsonResponse
    {
        try {
            return response()->json($this->countriesRepository->getAllCountries()->countries);
        } catch (\Throwable $e) {
            return response()->json(['error' => "Cannot fetch the countries."], 500);
        }
    }

    public function one(string $name): JsonResponse
    {
        try {
            return response()->json($this->countriesRepository->getCountry($name));
        } catch (NotFoundException $exception) {
            return response()->json(['error' => "Cannot find the country with name '$name'"], 404);
        } catch (\Throwable $e) {
            return response()->json(['error' => "Cannot fetch the country."], 500);
        }
    }
}
