<?php

namespace App\Repositories;

use App\Models\Partner;

class PartnerRepository
{
    public function all()
    {
        return Partner::all();
    }

    public function findById($id)
    {
        return Partner::findOrFail($id);
    }

    public function create(array $data)
    {
        return Partner::create($data);
    }

    public function update(Partner $partner, array $data)
    {
        $partner->update($data);
        return $partner;
    }

    public function delete(Partner $partner)
    {
        return $partner->delete();
    }
}
