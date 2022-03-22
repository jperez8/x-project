<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // protected $appends = ['type'];

    public function typeProfile()
    {
        return $this->belongsTo(TypeProfile::class);
    }

    // public function type(): Attribute
    // {
    //     return new Attribute(
    //         get: fn () => $this->typeProfile,
    //     );
    // }
}
