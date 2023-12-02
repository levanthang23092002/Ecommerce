<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Author;

class AdminAuthorEditComponent extends Component
{
    public $name;
    public $slug;
    public $bio;
    public $author_id;

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

    public function mount($author_id)
    {
        $author = Author::find($author_id);
        $this->author_id = $author->id;
        $this->name = $author->name;
        $this->slug = $author->slug;
        $this->bio = $author->bio;
    }
    

    public function updateAuthor()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'bio' => 'required'
        ]);
        $author = Author::find($this->author_id);
        $author->name= $this->name;
        $author->bio= $this->bio;
        $author->slug= $this->slug;
        $author->save();
        session()->flash('message', 'Đã cập nhật tác giả thành công!');
    }

    public function render()
    {
        return view('livewire.admin.admin-author-edit-component');
    }
}
