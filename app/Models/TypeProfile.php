<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProfile extends Model
{
    CONSt TYPES = ["designer", "influencer", "casual"];
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
