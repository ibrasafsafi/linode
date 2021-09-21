<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ListAccounts extends Component
{

    public $accounts;
//    public $updatedAccount;
    public array $newAccount = [];
    protected $listeners = ['refresh'=> '$refresh'];

    public function mount()
    {
        $this->loadAccount();
    }

    public function render()
    {
        return view('livewire.list-accounts');
    }

    public function loadAccount()
    {
        $this->accounts = Account::all();
    }

    public function create()
    {
        $addAccount = Account::create([
            'label' => $this->newAccount['label'],
            'default_password' => $this->newAccount['pass'],
//            'default_password' => Hash::make($this->newAccount['pass']),
            'token' => $this->newAccount['token'],
        ]);
//        $addAccount->save();
//        $this->emitSelf('refresh');
        return redirect('/accounts');
    }

    public function edit(int $id)
    {
        $this->updatedAccount = Account::findOrFail($id);
    }

    public function update()
    {
        $updateAccount = Account::findOrFail($this->updatedAccount)->update([
            'label' => $this->newAccount['label'],
//            'default_password' => Hash::make($this->newAccount['pass']),
            'default_password' => $this->newAccount['pass'],
            'token' => $this->newAccount['token'],
        ]);
        return redirect('/accounts');

    }

    public function delete(int $id)
    {
        Account::query()->findOrFail($id)->delete();
        return redirect('/accounts');
    }



}
