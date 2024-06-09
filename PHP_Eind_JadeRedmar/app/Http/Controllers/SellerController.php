<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\SellerReview;

class SellerController extends Controller
{
    public function show(Request $request, $id)
    {
        $seller = User::findOrFail($id);
        return $this->showSeller($request, $seller);
    }

    public function showByCustomUrl(Request $request, $custom_url)
    {
        $seller = User::where('custom_url', $custom_url)->firstOrFail();
        return $this->showSeller($request, $seller);
    }

    private function showSeller(Request $request, $seller)
    {
        $advertisementsQuery = Advertisement::where('verkoper_id', $seller->id);
        $sellerReviewsQuery = SellerReview::where('seller_id', $seller->id)->with('review.user');

        // Search
        $search = $request->input('search');
        if ($search) {
            $advertisementsQuery->where('titel', 'like', "%$search%");
            $sellerReviewsQuery->whereHas('review', function ($query) use ($search) {
                $query->where('content', 'like', "%$search%");
            });
        }

        // Pagination
        $advertisements = $advertisementsQuery->paginate(10);
        $sellerReviews = $sellerReviewsQuery->paginate(10);

        return view('sellers.show', compact('seller', 'advertisements', 'sellerReviews', 'search'));
    }
}
