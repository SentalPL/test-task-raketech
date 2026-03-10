<?php

namespace App\DTO;

class CountryDTO
{
    public string $name;
    public string $flagIconUrl;
    public string $region;
    public ?string $language = null;
    public ?string $capital = null;
    public ?string $currency = null;
    public ?int $population = null;
}
