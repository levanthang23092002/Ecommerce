<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPublishersComponent extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $publishers = Brand::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate(5);
    
        return view('livewire.admin.admin-publishers-component', ['publishers' => $publishers])->layout('layouts.guest');
    }

    public function clearSearch()
    {
        $this->search = '';
    }
}
