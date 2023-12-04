<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAuthorsComponent extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $authors = Author::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'ASC')
            ->paginate(5);
    
            return view('livewire.admin.admin-authors-component',['authors'=>$authors]);
    }

    public function clearSearch()
    {
        $this->search = '';
    }

}
