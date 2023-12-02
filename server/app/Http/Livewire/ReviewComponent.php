<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewComponent extends Component
{
    public $productId;
    public $rating;
    public $comment;

    public function render()
    {
        return view('livewire.review-component');
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $this->productId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->reset(['rating', 'comment']);
        $this->emitUp('refreshComponent');
    }
}

