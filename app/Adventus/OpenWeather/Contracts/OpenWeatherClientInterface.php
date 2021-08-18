<?php
namespace App\Adventus\OpenWeather\Contracts;

interface OpenWeatherClientInterface
{
    public function saveCityData($userId, $loginTime);
}
