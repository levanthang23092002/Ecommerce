<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;

class AdminProductDeleteComponent extends Component
{
    public $product_id;
    public function render()
    {
        return view('livewire.admin.admin-product-delete-component')->layout('layouts.guest') ;
    }
    public function mount($product_id){
        $product = Product::find($product_id);
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->image = $product->image;
        $this->stock_status = $product->stock_status;
        $this->quantity = $product->quantity;
        $this->category_id = $product->category_id;
        $this->publisher_id = $product->publisher_id;
    }

    public function cancelDelete()
    {
        return redirect('/seller/products');

    }

    public function deleteProduct()
    {
        $product = Product::find($this->product_id);
        $product->delete();
        session()->flash ('message', 'Đã xoá sản phẩm thành công!');
    }
}
