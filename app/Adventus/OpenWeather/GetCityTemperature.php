<?php
namespace App\Adventus\OpenWeather;

use App\Adventus\OpenWeather\Contracts\ApiOutputInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetCityTemperature
{
    protected $apiKey;
    protected $url;
    protected $formatter;

    public function __construct(ApiOutputInterface $formatter)
    {
        $this->url = "https://api.openweathermap.org/data/2.5/onecall";
        $this->apiKey = config('api.api_key');
        $this->formatter = $formatter;
        Log::channel('api-log')->info('OpenWeather client successfully initiated');
    }

    /**
     * Get data from OpenWeather API.
     *
     * @param array $city
     *
     * @return Response|null
     */
    public function data(array $city)
    {
        $exclude = "minutely,hourly,daily,alerts";
        $response = null;
        try {
            $response = Http::get($this->url, [
                'lat' => $city['lat'],
                'lon' => $city['long'],
                'exclude' => $exclude,
                'appid' => $this->apiKey,
                'units' => 'metric' //temperature in Celsius
            ]);
            $response = $this->formatter->output($response->body());

            Log::channel('api-log')->info('API response received successfully');
        } catch (\Exception $exception) {
            Log::channel('api-log')->error('API response failed');
            Log::channel('api-log')->error($exception->getMessage());
        }

        return $response;
    }
}
