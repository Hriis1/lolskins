<?php

namespace App\Http\Controllers;

use App\Models\SkinRating;
use Illuminate\Http\Request;

class SkinRatingController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->only(['user_id', 'champ_name', 'skin_name', 'usable', 'opinion', 'rating', 'best_skin']);

        SkinRating::create($formFields);

        return back()->with('messageSuccess', 'Skin rating added!');
    }
}
