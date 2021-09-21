<?php

namespace App\Http\Livewire;

use App\Models\Account;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Livewire\Component;

class CreateInstances extends Component
{
    use ResourceLoader;

    public array $error = [];
    private Client $client;
    private string $certificate;
    private string $uri = '/v4/linode/instances/';
    public $activeTab = 'dedicated';

    public $linodeId;

    public array $currentInstance = [];
    public $action;

    public $account;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->certificate = config('linode.certificate');

        $this->client = new Client([
            'base_uri' => config('linode.base_uri')
        ]);
    }

    public function mount($accountId, $linodeId = null, $action = '')
    {
        $this->account = Account::query()->findOrFail($accountId);
        $this->linodeId = $linodeId;
        if(!in_array($action, ['rebuild', '']))
            abort(404);
        else
            $this->action = $action;

        $this->loadRegions();
        $this->loadTypes();
        $this->loadImages();
        $this->currentInstance();
    }

    public function render()
    {
        return view('livewire.create-instances');
    }

    public function createInstance(): \Illuminate\Http\RedirectResponse
    {
        $this->error = [];
        $method = 'post';
        if (isset($this->linodeId)) {
            $this->uri .= $this->linodeId . '/' . $this->action;

            if($this->action === '') {
                $method = 'put';
            }
        }


//        $this->currentInstance['root_pass'] = 'vfvfv(¨^';

        try {
            $this->client->$method($this->uri, [
                'verify' => $this->certificate,
                'json' => $this->currentInstance,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->account->token,
                ]])->getBody()->getContents();
        } catch (ClientException $exception) {
            $this->error = json_decode($exception->getResponse()->getBody()->getContents(), true)['errors'];
        }

        return redirect()->back();
    }


    public function currentInstance()
    {
        $this->currentInstance = json_decode($this->client->get($this->uri . $this->linodeId, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
//                'Authorization' => $this->account->token,
            ]])->getBody()->getContents(), true);
    }


    public function setCurrentTab(string $id)
    {
        $this->activeTab = $id;
    }




}
