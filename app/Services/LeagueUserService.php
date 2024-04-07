<?php

namespace App\Services;

use App\Models\LeagueSplit;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;

class LeagueUserService
{
    public function calculatePoints(User $user)
    {
        $postUserScores = $user->posts->map(fn(Post $p) => $p->postUserScores)->flatten();
        $leagueSplit = $user->leagueSplits->where(fn(LeagueSplit $leagueSplit) => $leagueSplit->is_active)->first();

        $points = 0;

        foreach ($postUserScores as $postUserScore) {
            $points += $postUserScore->score * $leagueSplit->pivot->delta;
        }

        return $points;
    }
}
