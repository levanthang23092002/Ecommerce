<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Wish;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{   
    use WithPagination;
    public $pageSize = 12;
    public $orderBy ="Mặc định";
    public $q;
    public $search_term;
    public $min_value =10000;
    public $max_value = 900000;

    public function mount(){
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q .'%';
    }

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
        $query = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])
            ->where(function ($query) {
                $query->where('name', 'like', $this->search_term)
                    ->orWhere('description', 'like', $this->search_term);
            });
    
        if ($this->orderBy == "Giá: thấp đến cao") {
            $products = $query->orderBy('regular_price', 'ASC')->paginate($this->pageSize); 
        } elseif ($this->orderBy == "Giá: cao đến thấp") {
            $products = $query->orderBy('regular_price', 'DESC')->paginate($this->pageSize); 
        } elseif ($this->orderBy == 'Sản phẩm mới') {
            $products = $query->orderBy('created_at', 'DESC')->paginate($this->pageSize); 
        } else {
            $products = $query->paginate($this->pageSize); 
        }
    
        $categories = Category::orderBy('name', 'ASC')->get();
        
        return view('livewire.search-component', ['products' => $products, 'categories' => $categories ]);
    }
}