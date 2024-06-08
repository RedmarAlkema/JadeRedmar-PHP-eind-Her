<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\AdvertisementReview;
use App\Models\SellerReview;

class ReviewController extends Controller
{
    public function postSellerReview(Request $request)
    {
        $review = new Review();
        $review->content = $request->content;
        $review->rating = $request->rating; // Add this line to set the rating
        $review->user_id = auth()->id();
        $review->save();
    
        $sellerReview = new SellerReview();
        $sellerReview->seller_id = $request->seller_id;
        $sellerReview->review_id = $review->id;
        $sellerReview->save();
    
        return redirect()->back()->with('success', 'Review posted successfully.');
    }
    
    public function postAdvertisementReview(Request $request)
    {
        $review = new Review();
        $review->content = $request->content;
        $review->user_id = auth()->id();
        $review->save();

        $advertisementReview = new AdvertisementReview();
        $advertisementReview->advertisement_id = $request->advertisement_id;
        $advertisementReview->review_id = $review->id;
        $advertisementReview->save();

        return redirect()->back()->with('success', 'Review posted successfully.');
    }

    public function store(Request $request, $advertisementId)
    {
        $review = new Review();
        $review->content = $request->comment;
        $review->rating = $request->rating;
        $review->user_id = auth()->id();
        $review->save();

        $advertisementReview = new AdvertisementReview();
        $advertisementReview->advertisement_id = $advertisementId;
        $advertisementReview->review_id = $review->id;
        $advertisementReview->save();

        return redirect()->back()->with('success', 'Review posted successfully.');
    }
}

