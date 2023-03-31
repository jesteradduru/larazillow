<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOffer extends Controller
{
    //
    public function __invoke(Offer $offer)
    {
        $offer->update(['accepted_at' => now()]);

        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);

        $offer->listing->sold_at = now();

        $offer->listing->save();

        return redirect()->back()->with('success', 'Offer accepted, other offers are rejected.');
    }
}
