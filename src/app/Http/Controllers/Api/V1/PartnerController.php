<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Services\PartnerService;
use App\Traits\ApiResponse;

class PartnerController extends Controller
{
    use ApiResponse;

    public function __construct(private PartnerService $service) {}

    public function index()
    {
        $partners = $this->service->list();
        return $this->success(PartnerResource::collection($partners)->toArray(request()), 'Partners fetched successfully');
    }

    public function show($id)
    {
        $partner = $this->service->show($id);
        return $this->success((new PartnerResource($partner))->toArray(request()), 'Partner details fetched successfully');
    }

    public function store(StorePartnerRequest $request)
    {
        $partner = $this->service->store($request->validated());
        return $this->success((new PartnerResource($partner))->toArray(request()), 'Partner created successfully');
    }

    public function update(StorePartnerRequest $request, $id)
    {
        $partner = $this->service->show($id);
        $updatedPartner = $this->service->update($partner, $request->validated());
        return $this->success((new PartnerResource($updatedPartner))->toArray(request()), 'Partner updated successfully');
    }

    public function destroy($id)
    {
        $partner = $this->service->show($id);
        $this->service->delete($partner);
        return $this->success([], 'Partner deleted successfully');
    }
}
