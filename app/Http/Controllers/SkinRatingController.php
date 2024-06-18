<?php

namespace App\Http\Controllers;

use App\Models\SkinRating;
use Illuminate\Http\Request;

class SkinRatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'champ_name' => 'required|string|max:255',
            'skin_name' => 'required|string|max:255',
            'usable' => 'required|boolean',
            'opinion' => 'nullable|string|max:1000',
            'rating' => 'sometimes|integer|min:0|max:10',
            'best_skin' => 'sometimes|boolean',
        ]);

        //Sanitize the input data (Laravel does some of this automatically)
        $formFields = array_map('strip_tags', $validatedData);

        //id of the current user
        $formFields['user_id'] = \Auth::user()->id;

        // Create a new skin rating using the validated and sanitized data
        SkinRating::create($formFields);

        return back()->with('messageSuccess', 'Skin rating added!');
    }

    public function edit(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'rating_id' => 'required|integer',
            'champ_name' => 'required|string|max:255',
            'skin_name' => 'required|string|max:255',
            'usable' => 'required|boolean',
            'opinion' => 'nullable|string|max:1000',
            'rating' => 'sometimes|integer|min:0|max:10',
            'best_skin' => 'sometimes|boolean',
        ]);

        //Sanitize the input data (Laravel does some of this automatically)
        $formFields = array_map('strip_tags', $validatedData);

        //id of the current user
        $formFields['user_id'] = \Auth::user()->id;

        //Get the rating to update
        $rating = SkinRating::findOrFail($formFields['rating_id']);

        unset($formFields['rating_id']);

        $rating->update($formFields);

        return back()->with('messageSuccess', 'Skin rating edited!');

    }

}
