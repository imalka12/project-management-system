<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use App\Models\Project;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public $client;

    public function __construct(ClientService $clientService) {
        $this->client = $clientService;
    }

    /**
     * show create client page to add client
     * 
     * @return void
     */
    public function showCreateClient()
    {
        $clients = Client::all();

        return view('clients', compact('clients'));
    }

    /**
     * process create client request
     * 
     * @param CreateClientRequest $request
     */
    public function addClient(CreateClientRequest $request)
    {
        $this->client->create($request);

        return redirect()->route('create-client')->with('success', 'New client added successfully.');
    }

    /**
     * process delete client request
     * 
     * @param Client $client
     */
    public function deleteClient(Client $client)
    {

        $this->client->delete($client);

        return redirect()->route('create-client')->with('success', 'Client deleted successfully.');
    }

    /**
     * show edit client page to update client details
     * 
     * @param Client client
     */
    public function editClient(Client $client){
         return view('clients-edit', compact('client'));
    }

    /**
     * process update client request
     * 
     * @param CreateClientRequest $request
     * @param Client $client
     */
    public function updateClient(CreateClientRequest $request, Client $client){
        
        $this->client->update($client, $request);

        return redirect()->route('create-client')->with('success', 'Client updated sucessfully.');
    }

    // public function selectClientProjects(Client $clients, Project $projects)
    // {
    //     $clients = Client::all();
    //     return view('project-client', compact('clients', 'projects'));
    // }

    public function showSelectorPage()
    {
        return view('project-client');
    }

    public function getAllClients()
    {
        $clients = Client::all();

        return $clients;
    }

    public function getProjectsByClient($client_id)
    {
        $projects = Project::whereClientId($client_id)->get();
        return $projects;
    }

    public function showClientsPage()
    {
        return view('clients_js');
    }

    public function createNewClient(CreateClientRequest $request)
    {
        $data = $request->validated();
        $client = Client::create($data);

        return $client;
    }

    public function getAllClient()
    {
        $clients = Client::all();
        return $clients;
    }

    public function deleteSelectedClient(Client $client)
    {
        $client->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Client record deleted successfully..',
        ]);
    }

    public function getClient(Client $client)
    {
        return $client;
    }

    public function updateSelectedClient(CreateClientRequest $request, Client $client)
    {
        $client->update([
            'name' => $request->get('name'),
            'company' => $request->get('company'),
            'address' => $request->get('address'),
            'telephone' => $request->get('telephone'),
            'email' => $request->get('email'),
            'contact_person' => $request->get('contact_person'),
            'contact_person_telephone' => $request->get('contact_person_telephone'),
            'contact_person_email' => $request->get('contact_person_email'),
            
        ]);

        return $client;
    }
}
