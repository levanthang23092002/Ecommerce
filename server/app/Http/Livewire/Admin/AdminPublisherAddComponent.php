<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Publisher; 

class AdminPublisherAddComponent extends Component
{
    public $name;
    public $slug;
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
    public function storePublisher()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Publisher::create([
            'name' => $this->name,
            'slug' => $this->slug
        ]);

        session()->flash('message', 'Đã thêm nhà phát hành thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-publisher-add-component')->layout('layouts.guest');
    }
}
