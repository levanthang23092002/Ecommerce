<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

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

    public function store($product_id, $product_name, $product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('shop.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        $this->emitTo('livewire.wishlist-icon-component','refreshComponent' );
    }

    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('livewire.wishlist-icon-component','refreshComponent' );
                return;
            }
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
        if($this->orderBy == "Giá: thấp đến cao"){
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('regular_price', 'ASC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == "Giá: cao đến thấp")
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('regular_price', 'DESC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == 'Sản phẩm mới')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('created_at', 'DESC')->paginate($this->pageSize); 
        }
        else {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->paginate($this->pageSize); 
        }
        $categories = Category::orderBy('name','ASC')->get();
        
        return view('livewire.search-component', ['products' => $products, 'categories'=>$categories ]);
    }
}