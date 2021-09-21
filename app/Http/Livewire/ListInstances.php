<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;

class ListInstances extends Component
{
    use ResourceLoader;

    private Client $client;
    private string $certificate;
    private string $uri = '/v4/linode/instances/';

//    public array $instances;
    public $selectedType;
    public $selectedRegion;
    public $accounts;
    public $token;
    public $authorization;


    public array $newInstance = [];
    public $currentLinodeId;

//    protected $listeners = ['setUpdatedLinodeId'];


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
//        $this->loadInstances();
        $this->loadRegions();
        $this->loadTypes();
        $this->loadAccounts();
    }

    public function render()
    {
        return view('livewire.list-instances');
    }

    public function reboot(int $linodeId)
    {
        $this->sendRequest('post', $this->uri . "{$linodeId}/reboot", true);

        /*$this->client->post($this->uri . "{$linodeId}/reboot", [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
        $this->loadInstances();
        */
    }

    public function delete(int $id)
    {
        $this->sendRequest('delete', $this->uri . $id, true);

        /* $this->client->delete($this->uri . $id, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
        $this->loadInstances();
        */
    }

    public function powerOff(int $id)
    {
        $this->sendRequest('post', $this->uri . $id . '/shutdown', true);
    }

    public function boot(int $id)
    {
        $this->sendRequest('post', $this->uri . $id . '/boot', true);
    }

    public function clone()
    {
        $this->sendRequest('post', $this->uri . $this->currentLinodeId . '/clone', true, $this->newInstance);
    }

    public function show()
    {
        $this->sendRequest('get', $this->uri . $this->currentLinodeId, true, $this->newInstance);
    }

    private function sendRequest($method, $url, bool $withRefresh = false, array $body = [])
    {
        if (sizeof($body) > 0)
            $this->client->$method($url, [
                'verify' => $this->certificate,
                'json' => $body,
                'headers' => [
                    'Authorization' => $this->authorization,
                ]]);
        else
            $this->client->$method($url, [
                'verify' => $this->certificate,
                'headers' => [
                    'Authorization' => $this->authorization,
                ]]);

//        if ($withRefresh) {
//            $this->loadInstances();
//        }
    }

    public function loadInstances()
    {
//        usleep(1000 * 10);
//        $this->changeAuth();
//        if (isset($this->authorization) && trim($this->authorization) !== '') {
//            $this->instances = json_decode($this->client->get($this->uri, [
//                'verify' => $this->certificate,
//                'headers' => [
//                    'Authorization' => $this->authorization,
//                ]])->getBody()->getContents(), true);
//        } else {
//            $this->instances = ['data' => []];
//        }
    }

    public function getInstancesProperty(): array
    {
        if (isset($this->authorization) && trim($this->authorization) !== '') {
            return json_decode($this->client->get($this->uri, [
                'verify' => $this->certificate,
                'headers' => [
                    'Authorization' => $this->authorization,
                ]])->getBody()->getContents(), true);
        } else {
            return ['data' => []];
        }
    }

    public function loadAccounts()
    {
        $this->accounts = Account::all();
    }

    public function setCurrentLinodeId(int $id)
    {
        $this->currentLinodeId = $id;
    }

//    public function setUpdatedLinodeId(int $id)
//    {
//        $this->currentLinodeId = $id;
//        $this->emitTo('UpdateInstances', 'updateInstance', $this->currentLinodeId);
//    }

/*    public function changeAuth()
    {
        $this->authorization = 'Bearer ' . $this->token;
    }*/
}
