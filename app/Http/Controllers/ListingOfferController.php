<?php
namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Listing $listing, Request $request)
    {
       
        $this->authorize('offer', $listing);

        $offer = $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount' => 'integer|required|min:1|max:2000000000'
                ])
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(new OfferMade($offer));

        return redirect()->back()->with('success', 'Offer made successfully');
    }
}
