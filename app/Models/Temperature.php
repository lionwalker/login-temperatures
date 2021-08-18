<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temperature extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'city',
        'temperature',
        'login_time'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'login_time' => 'datetime:D,d M Y, H:i a',
    ];

    /**
     * The attributes that should be append.
     *
     * @var array
     */
    protected $appends = [
        'temperature_fahrenheit'
    ];

    /**
     * Defines relationship with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Det temperature details only for currently logged in user.
     *
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserScope());
    }

    /**
     * Mutator to get temperature in fahrenheit.
     *
     * @return Float
     */
    public function getTemperatureFahrenheitAttribute(): float
    {
        $temperature = $this->temperature;
        $fahrenheit= (float)(($temperature * 9 / 5) + 32);
        return  number_format($fahrenheit,2);
    }
}
