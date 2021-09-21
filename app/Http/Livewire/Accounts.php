<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;

class Accounts extends Component
{
    //use ResourceLoader;
    private Client $client;
    public array $accounts;
    private string $certificate;



    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->certificate = config('linode.certificate');

        $this->client = new Client([
            'base_uri' => config('linode.base_uri')
        ]);
    }


    public function mount()
    {
        $this->loadAccounts();
    }

    public function render()
    {
        return view('livewire.accounts');
    }


    public function loadAccounts()
    {
        $this->accounts = json_decode($this->client->get('https://api.linode.com/v4/account', [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]])->getBody()->getContents(), true);
    }
}
