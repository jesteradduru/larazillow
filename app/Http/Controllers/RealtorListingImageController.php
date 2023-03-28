<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    //
    public function create(Listing $listing) 
    {
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/Create', 
            [
                'listing' => $listing
            ]
        );
    }

    public function store(Listing $listing, Request $request) {
        $listing->load('images');
        if($request->hasFile('images')){
            $request->validate([
                'images.*'=> 'mimes:png,jpg,jpeg,webp|max:5000' 
            ], [
                'images.*.mimes' => 'File must be an image (e.g. jpg, png, jpeg, webp)'
            ]);
            foreach ($request->file('images') as $file){
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }

        return redirect()->back()->with('success', 'Images saved successfully');
    }

    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
