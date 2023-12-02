<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $filterStockStatus = '';

    public function render()
    {
        $products = $this->filterStockStatus()
            ->orderBy('created_at', 'DESC')
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
