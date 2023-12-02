<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Publisher;

class AdminPublisherEditComponent extends Component
{
    public $name;
    public $slug;
    public $publisher_id;

    public function generateSlug()
    {
        $this->slug= Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required'
        ]);
    }    

    public function mount($publisher_id)
    {
        $publisher = Publisher::find($publisher_id);
        $this->publisher_id = $publisher->id;
        $this->name = $publisher->name;
        $this->slug = $publisher->slug;
    }
    

    public function updatePublisher()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        $publisher = Publisher::find($this->publisher_id);
        $publisher->name= $this->name;
        $publisher->slug= $this->slug;
        $publisher->save();
        session()->flash('message', 'Đã cập nhật nhà phát hành thành công!');
    }

    public function render()
    {
        return view('livewire.admin.admin-publisher-edit-component')->layout('layouts.guest');
    }
}
