<?php

namespace App\Services;

use App\Models\Partner;
use App\Repositories\PartnerRepository;

class PartnerService
{
    protected $repo;

    public function __construct(PartnerRepository $repo)
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

    public function update(Partner $partner, array $data)
    {
        return $this->repo->update($partner, $data);
    }

    public function delete(Partner $partner)
    {
        return $this->repo->delete($partner);
    }
}
