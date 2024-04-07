<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LeagueSplit extends Model
{
    use HasFactory;

    protected function isActive(): Attribute
    {
        return new Attribute(
            get: fn () => $this->split->start_date <= now() && $this->split->end_date >= now(),
        );
    }

    function league(){
        return $this->belongsTo(League::class);
    }

    function split()
    {
        return $this->belongsTo(Split::class);
    }

    function users()
    {
        return $this->belongsToMany(User::class)->withPivot('points');
    }
}
