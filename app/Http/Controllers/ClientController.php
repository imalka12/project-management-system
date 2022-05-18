<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showCreateClient()
    {
        $clients = Client::all();

        return view('clients', compact('clients'));
    }

    public function addClient(CreateClientRequest $request)
    {
        $data = $request->validated();

        Client::create($data);

        return redirect()->route('create-client')->with('success', 'New client added successfully.');
    }

    public function deleteClient(Client $client)
    {
        $client->delete();


        return redirect()->route('create-client')->with('success', 'Client deleted successfully.');
    }

    public function editClient(Client $client){
         return view('clients-edit', compact('client'));
    }

    public function updateClient(CreateClientRequest $request, Client $client){

        $client = Client::whereId($client->id)->first();

        $client->update([
            'name' => $request->get('name'),
            'company' => $request->get('company'),
            'address' => $request->get('address'),
            'telephone' => $request->get('telephone'),
            'email' => $request->get('email'),
            'contact_person' => $request->get('contact_person'),
            'contact_person_email' => $request->get('contact_person_email'),
            'contact_person_telephone' => $request->get('contact_person_telephone'),
        ]);

        return redirect()->route('create-client')->with('success', 'Client updated sucessfully.');
    }
}
