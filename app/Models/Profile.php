<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function type_profile()
    {
        return $this->hasOne(TypeProfile::class, 'type_profile_id');
    }
}
