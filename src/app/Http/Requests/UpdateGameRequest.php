<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseApiRequest;

class UpdateGameRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $gameId = $this->route('id'); 

        return [
            'partner_id'     => 'required|uuid|exists:partners,id',
            'provider_id'    => 'required|uuid|exists:providers,id',
            'category'       => 'required|string|max:255',
            'game_name'      => 'required|string|max:255',
            'slug'           => ['required', 'string', Rule::unique('games')->ignore($gameId)],
            'game_id'        => ['required', 'string', Rule::unique('games')->ignore($gameId)],
            'game_code'      => 'nullable|string|max:255',
            'game_model'     => 'nullable|string|max:255',
            'vendor'         => 'nullable|string|max:255',
            'desktop'        => 'boolean',
            'mobile'         => 'boolean',
            'launch_url'     => 'nullable|url',
            'thumbnail'      => 'nullable|url',
            'languages'      => 'nullable|array',
            'languages.*'    => 'string',
            'currencies'     => 'nullable|array',
            'currencies.*'   => 'string',
            'jackpot_info'   => 'nullable|array',
            'bonus_info'     => 'nullable|array',
            'games_log'      => 'nullable|array',
        ];
    }
}
