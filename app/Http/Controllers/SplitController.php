<?php

namespace App\Http\Controllers;

use App\Enums\TypeProfile;
use App\Models\League;
use App\Models\Split;
use Illuminate\Http\Request;

class SplitController extends Controller
{
    function getCurrentSplit()
    {
        $split = Split::whereDate('start_date', '<=', today())
            ->whereDate('end_date', '>=', today())
            ->first();

        $designersLeague = $split->leagues->where(function (League $league) {
            $league->load('users');
            return $league->type_profile == TypeProfile::Designer->value;
        });

        $influencersLeague = $split->leagues->where(function (League $league) {
            $league->load('users');
            return $league->type_profile == TypeProfile::Influencer->value;
        });

        return response()->json(
            [
                'designers' => $designersLeague,
                'influencers' => $influencersLeague
            ]
        );
    }
}
