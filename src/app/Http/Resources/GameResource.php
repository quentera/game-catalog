<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    return [
        'id'           => $this->id,
        // 'partner_id'   => $this->partner_id,
        // 'provider_id'  => $this->provider_id,
        'category'     => $this->category,
        'game_name'    => $this->game_name,
        'slug'         => $this->slug,
        'game_id'      => $this->game_id,
        'game_code'    => $this->game_code,
        'game_model'   => $this->game_model,
        'vendor'       => $this->vendor,
        'desktop'      => $this->desktop,
        'mobile'       => $this->mobile,
        'launch_url'   => $this->launch_url,
        'thumbnail'    => $this->thumbnail,
        'languages'    => $this->languages,
        'currencies'   => $this->currencies,
        'jackpot_info' => $this->jackpot_info,
        'bonus_info'   => $this->bonus_info,
        'games_log'    => $this->games_log,
        'partner' => [
            'id'   => $this->partner_id,
            'name' => optional($this->partner)->name,
        ],
        'provider' => [
            'id'   => $this->provider_id,
            'name' => optional($this->provider)->name,
        ],
        ];    
    }
}
