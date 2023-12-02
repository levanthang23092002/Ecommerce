<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use App\Models\Product;

class CartComponent extends Component
{
    public function increateQuantity($rowId){

        $product = Cart::instance('cart')->get($rowId);
        $products = Product::find($product->id);
        if($product->qty < $products->quantity)
            $qty = $product->qty + 1;
        else
            $qty = $product->qty;
        
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('livewire.cart-icon-component','refreshComponent' );
    }
    public function decreateQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('livewire.cart-icon-component','refreshComponent' );
    }

    public function destroy($id){
        Cart::instance('cart')->remove($id);
        $this->emitTo('livewire.cart-icon-component','refreshComponent' );
        session()->flash('success_message','Sản phẩm đã bị xoá');
        
    }

    public function clearAll(){
        Cart::instance('cart')->destroy();
        $this->emitTo('livewire.cart-icon-component','refreshComponent' );
    }
    public function render()
    {
        return view('livewire.cart-component');
    }
}
