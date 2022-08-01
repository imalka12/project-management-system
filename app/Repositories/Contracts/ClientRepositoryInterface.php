<?php
namespace App\Repositories\Contracts;

use App\Models\Client;
use Illuminate\Support\Arr;

interface ClientRepositoryInterface
{
    /**
     * create new client entry
     * 
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client;

    /**
     * delete selected client entry
     * 
     * @param mixed $id
     * @return boolean
     */
    public function delete($id): bool;

    /**
     * update selected client entry
     * 
     * @param Client $client
     * @param array $data
     * @return boolean
     */
    public function update(Client $client, array $data): bool;
}