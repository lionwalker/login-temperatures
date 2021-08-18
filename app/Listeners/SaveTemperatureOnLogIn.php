<?php

namespace App\Listeners;

use App\Adventus\OpenWeather\OpenWeatherClient;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SaveTemperatureOnLogIn implements ShouldQueue
{
    protected $client;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OpenWeatherClient $openWeatherClient)
    {
        $this->client = $openWeatherClient;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $userId = $event->user->getAuthIdentifier();
        $loginTime = now();
        $this->client->saveCityData($userId,$loginTime);
        Log::channel('api-log')->info("Event fired when login");
    }
}
