<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Livewire\Component;

class Menu extends Component
{
    protected $listeners = ['accountChanged'];

    public $accountId;

    public function mount(){
//        $this->accountChanged();
    }

    public function render()
    {
        return view('livewire.menu');
    }

    public function accountChanged($token) {
        $this->accountId = Account::query()->where('token', '=', $token)->get()->first()->id;
    }
}
