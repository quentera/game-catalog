<?php
namespace App\Repositories;

use App\Models\Game;

class GameRepository
{
    
    public function all()
    {
        return Game::with(['partner', 'provider'])->paginate(20);
    }

    public function findById($id)
    {
        return Game::with(['partner', 'provider'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Game::create($data);
    }

    public function update(Game $game, array $data)
    {
        $game->update($data);
        return $game;
    }

    public function delete(Game $game)
    {
        return $game->delete();
    }
}
