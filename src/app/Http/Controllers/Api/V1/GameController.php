<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Services\GameService;
use App\Http\Resources\GameResource;
use App\Http\Requests\StoreGameRequest;
use App\Models\Game;
use App\Http\Requests\UpdateGameRequest;

class GameController extends Controller
{
    use ApiResponse;
    private $service;
    public function __construct( GameService $service) {
        $this->service = $service;
    }

    public function index()
    {
        $games = $this->service->list();
        return $this->success(GameResource::collection($games)->toArray(request()), 'Games fetched successfully');
    }

    public function show($id)
    {
        $game = $this->service->show($id);
        return $this->success((new GameResource($game))->toArray(request()), 'Game details fetched successfully');
    }

    public function store(StoreGameRequest $request)
    {
        $game = $this->service->store($request->validated());
        return $this->success((new GameResource($game))->toArray(request()), 'Game created successfully');
    }

    public function update(UpdateGameRequest $request, $id)
    {
        $game = $this->service->show($id);
        $updated = $this->service->update($game, $request->validated());
        return $this->success((new GameResource($updated))->toArray(request()), 'Game updated successfully');
    }

    public function destroy($id)
    {
        $game = $this->service->show($id);
        $this->service->delete($game);
        return $this->success([], 'Game deleted successfully');
    }
}
