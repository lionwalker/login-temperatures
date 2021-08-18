<?php


namespace App\Adventus\OpenWeather;


use App\Models\Temperature;
use Illuminate\Support\Facades\Log;

class SaveCityTemperature
{
    protected $temperature;

    public function __construct(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * Save data to database from OpenWeather API.
     *
     * @param int $userId
     * @param string $loginTime
     * @param string $city
     * @param float $temperature
     */
    public function save($userId, $loginTime, $city, $temperature)
    {
        try {
            $this->temperature->create(['user_id' => $userId, 'login_time' => $loginTime, 'city' => $city, 'temperature' => $temperature]);
            Log::channel('api-log')->info("Temperature Store Successfully");
        } catch (\Exception $exception) {
            Log::channel('api-log')->error('Temperature Store Failed');
            Log::channel('api-log')->error($exception->getMessage());
        }
    }
}
