<?php
namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('offer', $listing);

        $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount' => 'integer|required|min:1|max:2000000000'
                ])
            )->bidder()->associate($request->user())
        );

        return redirect()->back()->with('success', 'Offer made successfully');
    }
}
