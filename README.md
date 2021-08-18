## About the project

This is a small webapp that will store the current temperature of two cities when a user logs in, and display a historical list of the users login temperatures.

### Technologies used

* Laravel 8
* SQLite
* Vue.js
* Open Weather API / https://openweathermap.org/api/one-call-api

### Design principles used

* SOLID

### Overview of the solution, and the reasons for decisions

* Used Laravel event listener to listen users login event and call OpenWeather API
* Implemented a OpenWeatherApiClient contract to define the class structure
* Implemented a ApiOutput interface to easily change the output type in the feature
* Used separate classes (OpenWeatherClient | GetCityTemperature | SaveCityTemperature) to implement single responsibility principle
* For debugging purposes new log channel called 'api-log' created
* Implemented a scope to get filtered temperatures to logged-in user

## Installation

Clone the repo locally:

```sh
git clone https://github.com/lionwalker/login-temperatures.git
cd login-temperatures
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Set OpenWeatherAPI KEY in .env
```sh
OPEN_WEATHER_MAP_API_KEY="KEY"
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```
