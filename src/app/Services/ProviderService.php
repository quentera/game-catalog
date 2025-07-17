<?php
namespace App\Services;

use App\Models\Provider;
use App\Repositories\ProviderRepository;

class ProviderService
{
    protected $repo;

    public function __construct(ProviderRepository $repo)
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

    public function update(Provider $provider, array $data)
    {
        return $this->repo->update($provider, $data);
    }

    public function delete(Provider $provider)
    {
        return $this->repo->delete($provider);
    }
}
