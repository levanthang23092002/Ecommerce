<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Author; 

class AdminAuthorAddComponent extends Component
{
    public $name;
    public $slug;
    public $bio;
    public function generateSlug()
    {
        $this->slug= Str::slug($this->name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'bio' => 'required'
        ]);
    }    
    public function storeAuthor()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'bio' => 'required'
        ]);

        Author::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'bio' => $this->bio
        ]);

        session()->flash('message', 'Đã thêm tác giả thành công!');
    }
}
