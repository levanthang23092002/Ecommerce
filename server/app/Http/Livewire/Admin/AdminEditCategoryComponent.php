<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminEditCategoryComponent extends Component
{
    public $name;
    public $slug;
    public $category_id;

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

    public function mount($category_id)
    {
        $category = Category::find($category_id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug= $category->slug;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        $category = Category::find($this->category_id);
        $category->name= $this->name;
        $category->slug= $this->slug;
        $category->save();
        session()->flash('message', 'Đã cập nhật danh mục thành công!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.guest') ;
    }
}
