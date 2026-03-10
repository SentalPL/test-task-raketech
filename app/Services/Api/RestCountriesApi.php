<?php

namespace App\Services\Api;

use App\DTO\CountryDTO;
use App\DTO\CountryDTOList;
use App\Exceptions\NotFoundException;
use App\Interfaces\CountriesApiInterface;

class RestCountriesApi extends BaseApiClient implements CountriesApiInterface
{
    protected string $baseUrl = 'https://restcountries.com/v3.1';

    public function getAllCountries(): CountryDTOList
    {
        $countries = $this->get('/all?fields=name,flags,region');

        return CountryDTOList::create(...array_map(fn($country) => $this->makeCountryDTO($country), $countries));
    }

    public function getCountry(string $name): CountryDTO
    {
        $country = $this->get('/name/' . strtolower($name));

        if (empty($country)) {
            throw new NotFoundException('Country not found');
        }

        return $this->makeCountryDTO($country[0]);
    }

    protected function makeCountryDTO(array $rawData): CountryDTO
    {
        $countryDTO = new CountryDTO();
        $countryDTO->name = $rawData['name']['common'] ?? '';
        $countryDTO->flagIconUrl = $rawData['flags']['png'] ?? '';
        $countryDTO->region = $rawData['region'] ?? '';
        $countryDTO->capital = $rawData['capital'][0] ?? null;
        $countryDTO->currency = array_key_first($rawData['currencies'] ?? []) ?: null;
        $countryDTO->population = $rawData['population'] ?? null;
        $countryDTO->language = array_first($rawData['languages'] ?? []) ?: null;

        return $countryDTO;
    }
}
