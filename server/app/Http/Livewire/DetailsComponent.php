<?php

namespace App\Http\Livewire;

use App\Models\Wish;
use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use App\Models\Review; 
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class DetailsComponent extends Component
{
    use WithPagination;
    public $slug;
    public $rating;
    public $comment;

    public $quantity;
    public $product;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->rating = 5;
        $this->quantity = 1;
        $this->product = Product::where('slug', $this->slug)->first();
    }

    public function store($product_id, $product_name, $product_price, $product_quantity = 1)
    {
        foreach (Cart::instance('cart')->content() as $cartItem) {
            if ($cartItem->id == $product_id) {
                Cart::instance('cart')->remove($cartItem->rowId);
                break; 
            }
        }
        Cart::instance('cart')->add($product_id, $product_name, $product_quantity, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Đã thêm vào giỏ hàng');
        return redirect()->route('shop.cart');
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

    public function incrementQuantity() {
        if($this->product) {
            if($this->quantity < $this->product->quantity) {
                $this->quantity += 1;
            }
        }
    }
    public function decrementQuantity(){
        if($this->product) {
            if($this->quantity > 1) {
                $this->quantity -= 1;
            }
        }
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required',
        ]);

        if (Auth::id() === null) {
            session()->flash('error_message', 'Bạn phải đăng nhập để đánh giá.');
            return;
        }
        if (!$this->userHasBoughtProduct($this->product->id)) {
            session()->flash('error_message', 'Bạn chỉ có thể đánh giá sau khi mua sản phẩm.');
            return;
        }

        if ($this->userHasReviewedProduct($this->product->id)) {
            $review = Review::where('user_id', Auth::user()->id)->where('product_id', $this->product->id)->first();
            $review->rating = $this->rating;
            $review->comment = $this->comment;
            $review->save();
            $this->reset(['comment']);
            session()->flash('success_message', 'Đã cập nhật đánh giá.');
            return;
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);
    
        $this->reset(['comment']);
        session()->flash('success_message', 'Đã gửi đánh giá của bạn.');
        return;
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
        if($this->product != null){
            $rproducts = Product::where('category_id', $this->product->category_id)->inRandomOrder()->limit(4)->get();
            $nproducts = Product::latest()->take(4)->get();
            $categories = Category::orderBy('name', 'ASC')->get();
            $publisher = Publisher::where('id', $this->product->publisher_id)->first();
            $author = Author::where('id', $this->product->author_id)->first();
            $reviews = Review::where('product_id', $this->product->id)->orderBy('updated_at', 'desc')->paginate(5);

            return view('livewire.details-component', [
                'product' => $this->product,
                'rproducts' => $rproducts,
                'nproducts' => $nproducts,
                'categories' => $categories,
                'publisher' => $publisher,
                'author' => $author,
                'reviews' => $reviews,
                'quantity' => $this->quantity,
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
                'quantity' => 0,
            ]);
        }
       

        
    }
}