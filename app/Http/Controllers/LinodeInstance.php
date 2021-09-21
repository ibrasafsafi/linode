<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

class LinodeInstance extends Controller
{
    private Client $client;
    private string $certificate;
    private string $uri = '/v4/linode/instances/';

    public function __construct()
    {
        $this->certificate = config('linode.certificate');

        $this->client = new Client([
            'base_uri' => config('linode.base_uri')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function index()
    {

            $instances = json_decode($this->client->get($this->uri, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]])->getBody()->getContents(), true);

            //return $instances['data'][0]['id'];
            return view('index', compact('instances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('livewire.create-instances');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function store(Request $request): ResponseInterface
    {
        $body = json_decode(file_get_contents(base_path('create-instance.json')));

        return $this->client->post($this->uri, [
            'verify' => $this->certificate,
            'json' => $body,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
    }

    public function reboot($linodeId)
    {
         $this->client->post($this->uri . "{$linodeId}/reboot", [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
        return redirect(route('instances.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function show(int $id): ResponseInterface
    {
        return $this->client->get($this->uri . $id, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function destroy(int $id): ResponseInterface
    {
        return $this->client->delete($this->uri . $id, [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]]);
    }
}
