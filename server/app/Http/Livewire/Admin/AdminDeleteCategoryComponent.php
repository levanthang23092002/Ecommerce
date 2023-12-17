<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class AdminDeleteCategoryComponent extends Component
{
    public $category_id;

    public function render()
    {
        return view('livewire.admin.admin-delete-category-component')->layout('layouts.guest') ;
    }

    public function mount($category_id)
    {
        $category = Category::find($category_id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug= $category->slug;
    }

    public function cancelDelete()
    {
        return redirect('/seller/categories');

    }

    public function deleteCategory()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        session()->flash ('message', 'Đã xoá danh mục thành công!');
    }
}
