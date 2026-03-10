<?php

namespace App\Interfaces;

use App\DTO\CountryDTO;
use App\DTO\CountryDTOList;

interface CountriesApiInterface
{
    public function getAllCountries(): CountryDTOList;

    public function getCountry(string $name): CountryDTO;
}
