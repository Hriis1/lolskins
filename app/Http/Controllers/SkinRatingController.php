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

        //Check if this user already has rating for this skin
        $sameSkinRating = SkinRating::where('user_id', $user_id)
            ->where('skin_name', $formFields['skin_name'])
            ->where('deleted', false)
            ->exists();

        if ($sameSkinRating) {
            //if a rating was found
            return back()->with('messageError', 'You already have a rating of this skin!');

        }

        //If this is marked as best skin check if user has marked other skin of same champ as best and unmark it
        if (isset($formFields['best_skin']) && $formFields['best_skin']) {

            $bestSkinRating = SkinRating::where('user_id', $user_id)
                ->where('champ_name', $formFields['champ_name'])
                ->where('best_skin', true)
                ->where('deleted', false)
                ->first();

            if ($bestSkinRating) {
                $bestSkinRating->best_skin = false;
                $bestSkinRating->save();
            }
        }

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
        $user_id = \Auth::user()->id;

        unset($formFields['rating_id']);

        // If this is marked as best skin, check if user has marked other skin of same champ as best and unmark it
        if ($formFields['best_skin']) {
            $bestSkinRating = SkinRating::where('user_id', $user_id)
                ->where('champ_name', $formFields['champ_name'])
                ->where('best_skin', true)
                ->where('deleted', false)
                ->first();

            if ($bestSkinRating) {
                $bestSkinRating->best_skin = false;
                $bestSkinRating->save();
            }
        }

        $rating->update($formFields);

        return back()->with('messageSuccess', 'Skin rating edited!');

    }

    public function delete($id)
    {
        SkinRating::where('id', $id)
            ->update(['deleted' => true]);

        return back()->with('messageSuccess', 'Skin rating deleted!');
    }

}
