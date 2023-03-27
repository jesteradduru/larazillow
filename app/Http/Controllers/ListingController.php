<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = $request->only(
            ['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']
        );

        return inertia('Listing/Index', 
        [
            'filters' => $filters,
            'listings' => Listing::latest()
                        ->filter($filters)
                        ->paginate(10)
                        ->withQueryString()
        ]);
    }


    
     /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load(['images']);
        return inertia('Listing/Show', [
            'listing' => $listing 
        ]);
    }

}
