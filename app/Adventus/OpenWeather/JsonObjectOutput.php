<?php
namespace App\Adventus\OpenWeather;

use App\Adventus\OpenWeather\Contracts\ApiOutputInterface;

class JsonObjectOutput implements ApiOutputInterface
{
    /**
     * Get data from OpenWeather API.
     *
     * @param string $response
     *
     * @return object
     */
    public function output($response)
    {
        return json_decode($response);
    }
}
