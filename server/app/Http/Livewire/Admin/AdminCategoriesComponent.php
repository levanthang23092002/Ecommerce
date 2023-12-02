<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component 
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate(5);
    
            return view('livewire.admin.admin-categories-component')
            ->layout('layouts.guest') // Set your layout file here
            ->with(['categories' => $categories]);
    }

    public function clearSearch()
    {
        $this->search = '';
    }
    

}
