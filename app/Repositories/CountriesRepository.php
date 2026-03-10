<?php

namespace App\Repositories;

use App\DTO\CountryDTOList;
use App\Interfaces\CountriesApiInterface;
use App\Interfaces\CountriesRepositoryInterface;
use App\DTO\CountryDTO;

class CountriesRepository extends BaseRepository implements CountriesRepositoryInterface
{
    public function __construct(protected CountriesApiInterface $countriesApi)
    {

    }

    public function getAllCountries(): CountryDTOList
    {
        return $this->getFromCacheOrSave('countries.all', fn() => $this->countriesApi->getAllCountries());
    }

    public function getCountry(string $name): CountryDTO
    {
        $cacheKey = 'country.' . strtolower($name);

        return $this->getFromCacheOrSave($cacheKey, fn() => $this->countriesApi->getCountry($name));
    }
}

