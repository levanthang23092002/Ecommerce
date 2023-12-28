<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

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

        Brand::create([
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
