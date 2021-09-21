<?php


namespace App\Http\Livewire;


trait ResourceLoader
{
    public array $regions;
    public array $types;
    public array $images;

    public function loadRegions()
    {
        $this->regions = json_decode($this->client->get('https://api.linode.com/v4/regions', [
            'verify' => $this->certificate,
        ])->getBody()->getContents(), true);
    }

    public function loadTypes()
    {
        $this->types = json_decode($this->client->get('https://api.linode.com/v4/linode/types', [
            'verify' => $this->certificate,
            'headers' => [
                'Authorization' => config('linode.authorization'),
            ]])->getBody()->getContents(), true);
    }

    public function loadImages()
    {
        $this->images = json_decode($this->client->get('https://api.linode.com/v4/images', [
            'verify' => $this->certificate,
            ])->getBody()->getContents(), true);
    }




}
