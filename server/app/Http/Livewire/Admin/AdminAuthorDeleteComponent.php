<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Author; 

class AdminAuthorDeleteComponent extends Component
{
    public $author_id;

    public function render()
    {
        return view('livewire.admin.admin-author-delete-component');
    }

    public function mount($author_id)
    {
        $author = Author::find($author_id);
        $this->author_id = $author->id;
        $this->name = $author->name;
        $this->slug= $author->slug;
    }

    public function cancelDelete()
    {
        return redirect('/admin/authors');

    }

    public function deleteAuthor()
    {
        $author = Author::find($this->author_id);
        $author->delete();
        session()->flash ('message', 'Đã xoá tác giả thành công!');
    }
}
