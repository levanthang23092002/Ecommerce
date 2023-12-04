<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Publisher; 

class AdminPublisherDeleteComponent extends Component
{
    public $publisher_id;

    public function render()
    {
        return view('livewire.admin.admin-publisher-delete-component')->layout('layouts.guest');
    }

    public function mount($publisher_id)
    {
        $publisher = Publisher::find($publisher_id);
        $this->publisher_id = $publisher->id;
        $this->name = $publisher->name;
        $this->slug= $publisher->slug;
    }

    public function cancelDelete()
    {
        return redirect('/admin/publishers');

    }

    public function deletePublisher()
    {
        $publisher = Publisher::find($this->publisher_id);
        $publisher->delete();
        session()->flash ('message', 'Đã xoá nhà phát hành thành công!');
    }
}
