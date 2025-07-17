<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProviderService;
use App\Http\Requests\Provider\StoreProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Traits\ApiResponse;

class ProviderController extends Controller
{
    use ApiResponse;

    public function __construct(private ProviderService $service) {}

    public function index()
    {
        $providers = $this->service->list();
        return $this->success(ProviderResource::collection($providers)->toArray(request()), 'Providers fetched successfully');
    }

    public function show($id)
    {
        $provider = $this->service->show($id);
        return $this->success((new ProviderResource($provider))->toArray(request()), 'Provider details fetched successfully');
    }

    public function store(StoreProviderRequest $request)
    {
        $provider = $this->service->store($request->validated());
        return $this->success((new ProviderResource($provider))->toArray(request()), 'Provider created successfully');
    }

    public function update(StoreProviderRequest $request, $id)
    {
        $provider = $this->service->show($id);
        $updatedProvider = $this->service->update($provider, $request->validated());
        return $this->success((new ProviderResource($updatedProvider))->toArray(request()), 'Provider updated successfully');
    }

    public function destroy($id)
    {
        $provider = $this->service->show($id);
        $this->service->delete($provider);
        return $this->success([], 'Provider deleted successfully');
    }
}
