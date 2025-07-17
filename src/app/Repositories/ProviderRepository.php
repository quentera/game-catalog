<?php

namespace App\Repositories;

use App\Models\Provider;

class ProviderRepository
{
    public function all()
    {
        return Provider::all();
    }

    public function findById($id)
    {
        return Provider::findOrFail($id);
    }

    public function create(array $data)
    {
        return Provider::create($data);
    }

    public function update(Provider $provider, array $data)
    {
        $provider->update($data);
        return $provider;
    }

    public function delete(Provider $provider)
    {
        return $provider->delete();
    }
}
