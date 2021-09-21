<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Livewire\Component;

class UpdateInstances extends Component
{
    use ResourceLoader;

    public array $error = [];
    private Client $client;
    private string $certificate;
    private string $uri = '/v4/linode/instances/';
    public $activeTab = 'dedicated';

    public array $newInstance = [];
    protected $listeners = ['updateInstance'];


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
        $this->loadRegions();
        $this->loadTypes();
        $this->loadImages();
    }


    public function render()
    {
        return view('livewire.update-instances');
    }


    public function updateInstance(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->error = [];
        $this->newInstance['root_pass'] = 'ggggggggggg';
        try {
            $this->client->put($this->uri . $id, [
                'verify' => $this->certificate,
                'json' => $this->newInstance,
                'headers' => [
                    'Authorization' => config('linode.authorization'),
                ]])->getBody()->getContents();
        } catch (ClientException $exception) {
            $this->error = json_decode($exception->getResponse()->getBody()->getContents(), true)['errors'];
        }
        return redirect()->back();
    }

    public function setCurrentTab(string $id)
    {
        $this->activeTab = $id;
    }

}
