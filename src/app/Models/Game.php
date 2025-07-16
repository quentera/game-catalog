<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'partner_id',
        'provider_id',
        'category',
        'game_name',
        'game_id',
        'desktop',
        'mobile',
        'games_log',
        'game_name',
        'slug',
        'game_id',
        'game_code',
        'game_model',
        'vendor',
        'desktop',
        'mobile',
        'launch_url',
        'thumbnail',
        'languages',
        'currencies',
        'jackpot_info',
        'bonus_info',
        'games_log',
    ];

    protected $casts = [
        'languages' => 'array',
        'currencies' => 'array',
        'jackpot_info' => 'array',
        'bonus_info' => 'array',
        'games_log' => 'array',
        'desktop' => 'boolean',
        'mobile' => 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
   
    public function partner() {
        return $this->belongsTo(Partner::class);
    }
    public function provider() {
        return $this->belongsTo(Provider::class);
    }

}
