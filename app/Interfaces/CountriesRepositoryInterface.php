<?php

namespace App\Interfaces;

use App\DTO\CountryDTO;
use App\DTO\CountryDTOList;

interface CountriesRepositoryInterface
{
    public function getAllCountries(): CountryDTOList;

    public function getCountry(string $name): CountryDTO;
}
