<?php
namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Client
    {
        return Client::create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return Client::whereId($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(Client $client, array $data): bool
    {
        return $client->update($data);
    }
}