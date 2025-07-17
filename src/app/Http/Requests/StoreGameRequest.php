<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Validation\Rule;

class StoreGameRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'partner_id'   => 'required|uuid|exists:partners,id',
            'provider_id'  => 'required|uuid|exists:providers,id',
            'category'     => 'nullable|string',
            'category_type'=> 'nullable|string',
            'game_name'    => 'required|string',
            'slug'         => 'required|string|unique:games,slug',
            'game_id'      => 'required|string|unique:games,game_id',
            'game_code'    => 'nullable|string',
            'game_model'   => 'nullable|string',
            'vendor'       => 'nullable|string',
            'desktop'      => 'required|boolean',
            'mobile'       => 'required|boolean',
            'launch_url'   => 'nullable|url',
            'thumbnail'    => 'nullable|url',
            'languages'    => 'nullable|array',
            'currencies'   => 'nullable|array',
            'jackpot_info' => 'nullable|array',
            'bonus_info'   => 'nullable|array',
            'games_log'    => 'nullable|array',
        ];
    }
}
