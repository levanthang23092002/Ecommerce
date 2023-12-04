<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Publisher;

class AdminPublishersComponent extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $publishers = Publisher::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate(5);
    
        return view('livewire.admin.admin-publishers-component', ['publishers' => $publishers])->layout('layouts.guest');
    }

    public function clearSearch()
    {
        $this->search = '';
    }
}
