<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Repositories\ClientRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ClientController extends AppBaseController
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }

    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('clients.index');
    }

    /**
  /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->clientRepository->getData();
        $countries = $data['countries'];
        $highestId = Client::max('uuid');
        $data['uuid'] = ($highestId + 1) % 10000; // Ensure it is always 4 digits
        $uuid = str_pad($data['uuid'], 4, '0', STR_PAD_LEFT); // Pad with leading zeros if necessary
        $vatNoLabel = getVatNoLabel();

        return view('clients.create', compact('countries', 'vatNoLabel', 'uuid'));
    }
    public function store(CreateClientRequest $request): RedirectResponse
    {
        $input = $request->all();

        try {
            $this->clientRepository->store($input);
            Flash::success(__('messages.flash.client_created_successfully'));
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->route('clients.create')->withInput();
        }

        return redirect()->route('clients.index');
    }



    /**
     * @return Application|Factory|View
     */
    public function show(Client $client, Request $request): \Illuminate\View\View
    {
        $client->load('user.media', 'invoices.payments');
        $activeTab = $request->get('Active', 'overview');
        $data = $this->clientRepository->getData();
        $vatNoLabel = getVatNoLabel();

        return view('clients.show', compact('client', 'activeTab', 'vatNoLabel'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Client $client)
    {
        $data = $this->clientRepository->getData();
        $countries = $data['countries'];
        $vatNoLabel = getVatNoLabel();
        $client->load('user.media');
        $uuid = $client->uuid;
        return view('clients.edit', compact('client', 'countries', 'vatNoLabel', 'uuid'));
    }

    public function update(Client $client, UpdateClientRequest $request)
    {
        $input = $request->all();
        $client->load('user');

        try {
            $this->clientRepository->updateClient($input, $client);
            Flash::success(__('messages.flash.client_updated_successfully'));
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->back()->withInput();
        }

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client, Request $request): JsonResponse
    {
        $check = $request->get('clientWithInvoices');
        $invoiceModels = [
            Invoice::class,
        ];
        $result = canDelete($invoiceModels, 'client_id', $client->id);
        if ($check && $result) {
            return $this->sendError(__('messages.flash.client_cant_deleted'));
        }
        $client->user()->delete();
        $client->invoices()->delete();
        $client->delete();

        return $this->sendSuccess(__('messages.flash.client_deleted_successfully'));
    }
    public function getStates(Request $request): mixed
    {
        $countryId = $request->get('countryId');
        $states = getStates($countryId);

        return $this->sendResponse($states, __('messages.flash.status_retrieved_successfully'));
    }

    /**
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $stateId = $request->get('stateId');
        $cities = getCities($stateId);

        return $this->sendResponse($cities, __('messages.flash.cities_retrieved_successfully'));
    }

    public function uploadCSV(Request $request)
    {


        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        try {
            // Open and read the CSV file
            $csvData = array_map('str_getcsv', file($file->getRealPath()));
           
            // Extract the header row
            $header = array_map('trim', $csvData[0]);
            $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);
            unset($csvData[0]); // Remove the header row from data

            // Process the CSV data
            foreach ($csvData as $index => $row) {
                $clientData = array_combine($header, $row);

                // Set a default password (you may want to generate a unique one or get from user input)
                $password = '123456';
                $clientData['password'] = $password;
                $clientData['avatar_remove'] = 1;
                $phoneNumber = $clientData['contact'];

                // Example of region extraction logic
                $region = substr($phoneNumber, 0, 3);
                $clientData['region_code'] = $region;

                try {
                    $this->clientRepository->store($clientData);
                } catch (Exception $exception) {
                    Flash::error(__('Error creating client from CSV on row ' . ($index + 1) . ': ' . $exception->getMessage()));
                    continue;
                }
            }
            Flash::success(__('messages.flash.client_created_successfully'));
            return redirect()->route('clients.create')->withInput();
        } catch (Exception $exception) {
            Flash::error(__('An error occurred while processing the CSV file: ' . $exception->getMessage()));
            return redirect()->route('clients.create')->withInput();
        }
    }
    public function delete($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            session()->flash('message', 'Client deleted successfully.');
            $this->emit('clientDeleted');
        } else {
            session()->flash('error', 'Client not found.');
        }
    }

    public function deleteSelected(Request $request)
    {
        $request->validate([
            'selectedClients' => 'required|array',
            'selectedClients.*' => 'exists:clients,id',
        ]);
        
        $clientIds = $request->selectedClients;
        foreach($clientIds as $clientId){
            $client = Client::find($clientId);
            $check = $request->get('clientWithInvoices');
            $invoiceModels = [
                Invoice::class,
            ];
            $result = canDelete($invoiceModels, 'client_id', $client->id);
            if ($check && $result) {
                return $this->sendError(__('messages.flash.client_cant_deleted'));
            }
            $client->user()->delete();
            $client->invoices()->delete();
            $client->delete();
    
        }


        return $this->sendSuccess(__('messages.flash.client_deleted_successfully'));
    }
}
