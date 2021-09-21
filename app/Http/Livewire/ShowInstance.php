<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;

class ShowInstance extends Component
{

    use ResourceLoader;

    public array $error = [];
    private Client $client;
    private string $certificate;
    private string $uri = '/v4/linode/instances/';


    public array $currentInstance = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->certificate = config('linode.certificate');

        $this->client = new Client([
            'base_uri' => config('linode.base_uri')
        ]);
    }

    public function mount($linodeId)
    {
        $this->linodeId = $linodeId;
        $this->currentInstance();
    }

    public function render()
    {
        return view('livewire.show-instance');
    }

    public function currentInstance()
    {
        $this->currentInstance = json_decode($this->client->get($this->uri . $this->linodeId, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]])->getBody()->getContents(), true);
    }

}
