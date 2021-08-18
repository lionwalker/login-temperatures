<?php

namespace App\Adventus\OpenWeather;

use App\Adventus\OpenWeather\Contracts\OpenWeatherClientInterface;
use App\Models\Temperature;
use Illuminate\Support\Facades\Log;

class OpenWeatherClient implements OpenWeatherClientInterface
{
    protected $temperature;

    public function __construct(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    public function saveCityData($userId, $loginTime)
    {
        $cities = config('api.cities');
        if (!empty($cities)) {
            foreach ($cities as $key => $city) {
                $get = new GetCityTemperature(new JsonObjectOutput);
                $temperatureData = $get->data($city);
                $temperature = $temperatureData->current->temp;
                try {
                    $data = new SaveCityTemperature(new Temperature);
                    $data->save($userId, $loginTime, $key, $temperature);
                    Log::channel('api-log')->info("Temperature saved successfully for city $key");
                } catch (\Exception $exception){
                    Log::channel('api-log')->error("Temperature saving failed for city $key");
                    Log::channel('api-log')->error($exception->getMessage());
                }
            }
        } else {
            Log::channel('api-log')->error("Cities not configured");
        }
    }
}
