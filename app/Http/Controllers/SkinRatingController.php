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
        $user_id = \Auth::user()->id;

        // Create a new skin rating using the validated and sanitized data
        $newSkinRating = SkinRating::create($formFields);

        //If this is marked as best skin check if user has marked other skin of same champ as best and unmark it
        if (isset($formFields['best_skin']) && $formFields['best_skin']) {

            $skinRatings = SkinRating::where('user_id', $user_id)
                ->where('champ_name', $formFields['champ_name'])
                ->where('deleted', false)
                ->get();

            // Loop through the skin ratings and unmark best_skin for others
            foreach ($skinRatings as $skinRating) {
                if ($skinRating->id != $newSkinRating->id && $skinRating->best_skin) {
                    $skinRating->best_skin = false;
                    $skinRating->save();
                }
            }
        }

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
        $user_id = \Auth::user()->id;

        unset($formFields['rating_id']);

        $rating->update($formFields);

        // If this is marked as best skin, check if user has marked other skin of same champ as best and unmark it
        if ($rating->best_skin) {
            $skinRatings = SkinRating::where('user_id', $user_id)
                ->where('champ_name', $formFields['champ_name'])
                ->where('deleted', false)
                ->get();

            // Loop through the skin ratings and unmark best_skin for others
            foreach ($skinRatings as $skinRating) {
                if ($skinRating->id != $rating->id && $skinRating->best_skin) {
                    $skinRating->best_skin = false;
                    $skinRating->save();
                }
            }
        }

        return back()->with('messageSuccess', 'Skin rating edited!');

    }

    public function delete($id)
    {
        SkinRating::where('id', $id)
            ->update(['deleted' => true]);

        return back()->with('messageSuccess', 'Skin rating deleted!');
    }

}
