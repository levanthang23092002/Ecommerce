<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Wish;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;
    public $pageSize = 8;
    public $orderBy ="Default Sorting";
    public $min_value =0;
    public $max_value = 100000000;

    public function store($product_id, $product_name, $product_price, $product_quantity = 1)
    {
        if(Auth::check()) {
            $cart = Auth::user()->carts->where('product_id', $product_id)->first();
            if($cart) {
                $cart->update(['quantity'=> $product_quantity]);
                session()->flash('success_message', 'Đã thêm vào giỏ hàng');
                return redirect()->route('shop.cart');
            }
    
            Cart::create(['product_id' => $product_id, 'user_id' => Auth::user()->id, 'quantity' => $product_quantity]);
            session()->flash('success_message', 'Đã thêm vào giỏ hàng');
            return redirect()->route('shop.cart');
        }
        return redirect()->route('login');
    }
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        if(!Wish::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->exists()) {
            Wish::create([
                'user_id'=> Auth::user()->id,
                'product_id'=> $product_id,
            ]);
        }
    }

    public function removeFromWishlist($product_id){
        $wish = Wish::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->first();
        if($wish) {
            $wish->delete();
        }
    }

    public function changePageSize($size){
        $this->pageSize = $size;
    }

    public function changeOrderBy($order){
        $this->orderBy = $order;
    }

    public function render()
    {
        
        $products = Product::paginate(8); 
        if($this->orderBy == "Price: Low to High"){
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == "Price: High to Low")
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == 'Sort By Newness')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('created_at', 'DESC')->paginate($this->pageSize); 
        }
        else {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->paginate($this->pageSize); 
        }
        $categories = Category::orderBy('name','ASC')->get();
        return view('livewire.home-component', ['products' => $products, 'categories'=>$categories]);
    }
}
