<?php

namespace App\DTO;

class CountryDTOList
{
    /** @var CountryDTO[]|array $countries */
    public array $countries;

    public static function create(CountryDTO ...$countryDTO): self
    {
        $list = new self();
        $list->countries = $countryDTO;

        return $list;
    }

    public function __toString(): string
    {
        return json_encode($this->countries);
    }
}
