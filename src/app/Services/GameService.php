<?php
namespace App\Services;
use App\Models\Game;
use App\Repositories\GameRepository;

class GameService
{
    protected $repo;

    public function __construct(GameRepository $repo)
    {

        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function show($id)
    {
        return $this->repo->findById($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Game $game, array $data)
    {
        return $this->repo->update($game, $data);
    }

    public function delete(Game $game)
    {
        return $this->repo->delete($game);
    }
}
