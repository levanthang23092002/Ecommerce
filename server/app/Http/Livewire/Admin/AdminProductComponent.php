<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $filterStockStatus = '';

    public function render()
    {
        $user = Auth::user();
        $products = $this->filterStockStatus()
            ->where('user_id', $user->id)
            ->orderBy('id', 'ASC')
            ->paginate(5);

        return view('livewire.admin.admin-product-component', ['products' => $products])->layout('layouts.guest');
    }

    public function filterStockStatus()
    {
        $query = Product::where('name', 'like', '%' . $this->search . '%');

        if ($this->filterStockStatus) {
            $query->where('stock_status', $this->filterStockStatus);
        }

        return $query;
    }
    public function clearSearch()
    {
        $this->search = '';
    }
}
