<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    function splits()
    {
        return $this->belongsToMany(Split::class)->withPivot('prize_ids');
    }

    function users()
    {
        return $this->belongsToMany(User::class)->withPivot('points');
    }
}
