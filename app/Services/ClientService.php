<?php
namespace App\Services;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;

class ClientService
{
    public $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    public function create(CreateClientRequest $request): Client
    {
        $data = $request->validated();

        return $this->clientRepository->create($data);
    }

    public function delete(Client $client)
    {
        return $this->clientRepository->delete($client->id);
    }

    public function update(Client $client, CreateClientRequest $request)
    {
        $data = $request->validated();
        return $this->clientRepository->update($client, $data);
    }
}