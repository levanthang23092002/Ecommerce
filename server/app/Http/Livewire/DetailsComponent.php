<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Cart;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use App\Models\Review; 
use Illuminate\Support\Facades\Auth;

class DetailsComponent extends Component
{
    public $slug;
    public $rating;
    public $comment;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Đã thêm vào giỏ hàng');
        return redirect()->route('shop.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        $this->emitTo('livewire.wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('livewire.wishlist-icon-component', 'refreshComponent');
                return;
            }
        }
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required',
        ]);
    
        $product = Product::where('slug', $this->slug)->first();
        if (Auth::id() === null) {
            session()->flash('error_message', 'Bạn phải đăng nhập để đánh giá.');
            return;
        }
        if (!$this->userHasBoughtProduct($product->id)) {
            session()->flash('error_message', 'Bạn chỉ có thể đánh giá sau khi mua sản phẩm.');
            return;
        }

        if ($this->userHasReviewedProduct($product->id)) {
            session()->flash('error_message', 'Bạn đã đánh giá rồi.');
            return;
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);
    
        $this->reset(['rating', 'comment']);
    
        $this->emit('refreshReviews');
        return redirect()->route('product.details', ['slug' => $this->slug]);
    }
    
    private function userHasReviewedProduct($productId)
    {
        $user = Auth::user();
    
        
        return Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();
    }

    private function userHasBoughtProduct($productId)
    {
        $user = Auth::user();
    
        $hasBought = $user->orders()->whereHas('items', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->where('order_status', 3)->exists();
    
        return $hasBought;
    }
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        if($product != null){
            $rproducts = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
            $nproducts = Product::latest()->take(4)->get();
            $categories = Category::orderBy('name', 'ASC')->get();
            $publisher = Publisher::where('id', $product->publisher_id)->first();
            $author = Author::where('id', $product->author_id)->first();
            $reviews = Review::where('product_id', $product->id)->get(); 

            return view('livewire.details-component', [
                'product' => $product,
                'rproducts' => $rproducts,
                'nproducts' => $nproducts,
                'categories' => $categories,
                'publisher' => $publisher,
                'author' => $author,
                'reviews' => $reviews,
            ]);
        }else{
            return view('livewire.details-component', [
                'product' => null,
                'rproducts' => null,
                'nproducts' => null,
                'categories' => null,
                'publisher' => null,
                'author' => null,
                'reviews' => null,
            ]);
        }
       

        
    }
}
