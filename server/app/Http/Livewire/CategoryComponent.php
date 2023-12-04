<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{   
    use WithPagination;
    public $pageSize = 12;
    public $orderBy ="Mặc định";
    public $slug ;
    public $min_value =10000;
    public $max_value = 900000;

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

    public function mount($slug){
        $this->slug =$slug;
    }

    public function render()
    {   
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if($this->orderBy == "Giá: thấp đến cao"){
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id',$category_id)->orderBy('regular_price', 'ASC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == "Giá: cao đến thấp")
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id',$category_id)->orderBy('regular_price', 'DESC')->paginate($this->pageSize); 
        }
        else if($this->orderBy == 'Sản phẩm mới')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id',$category_id)->orderBy('created_at', 'DESC')->paginate($this->pageSize); 
        }
        else {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id',$category_id)->paginate($this->pageSize); 
            
        }
        $categories = Category::orderBy('name','ASC')->get();
        
        return view('livewire.category-component', ['products' => $products, 'categories'=>$categories ,'category_name' => $category_name]);
    }
}