<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserOrderDetailComponent extends Component
{
    public function mount()
    {
        $this->order = session('order');
        $this->orderItems = session('orderItems');
        $this->products = session('products');
    }
    public function render()
    {
        return view('livewire.user.user-order-detail-component', ['order' => $this->order, 'orderItems' => $this->orderItems, 'products'=>$this->products]);
    }
}
