<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Wish;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class HomeComponent extends Component
{
    use WithPagination;
    public $pageSize = 8;
    public function store($product_id, $product_name, $product_price, $product_quantity = 1)
    {
        if (Auth::check()) {
            $cart = Auth::user()->carts->where('product_id', $product_id)->first();
            if ($cart) {
                $cart->update(['quantity' => $product_quantity]);
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
        if (!Wish::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->exists()) {
            Wish::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
            ]);
        }
    }

    public function removeFromWishlist($product_id)
    {
        $wish = Wish::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->first();
        if ($wish) {
            $wish->delete();
        }
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function render()
    {
        $bestSellProducts = Product::get()->sortByDesc('quantity_sold')->values()->all();
        $bestSellProducts = array_slice($bestSellProducts, 0, 8);
        $newProducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $recommendedProducts = [];
        if (Auth::check()) {
            $favoriteCategoryCart = Auth::user()->carts->map(function ($cart) {
                return $cart->product ? $cart->product->category_id : null;
            })->filter()->unique();

            $favoriteCategoryOrders = Auth::user()->orders->map(function ($orderItem) {
                return $orderItem->product ? $orderItem->product->category_id : null;
            })->filter()->unique();

            $favoriteCategoryWishes = Auth::user()->wishes->map(function ($wish) {
                return $wish->product ? $wish->product->category_id : null;
            })->filter()->unique();
            $favoriteCategory = $favoriteCategoryCart->merge($favoriteCategoryOrders)->merge($favoriteCategoryWishes)->unique();
            $recommendedProducts = Product::whereIn('category_id', $favoriteCategory)->inRandomOrder()->get()->take(8);
        }
        $recommendedProducts = collect($recommendedProducts)->merge(
            Product::inRandomOrder()->get()->take(8)
        )->unique();
        $recommendedProducts = $recommendedProducts->take(8);
        return view('livewire.home-component', ['recommended_products' => $recommendedProducts, 'new_products' => $newProducts, 'best_sell_products' => $bestSellProducts]);
    }
}
