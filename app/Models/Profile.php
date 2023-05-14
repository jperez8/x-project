<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean'
    ];

    public function typeProfile()
    {
        return $this->belongsTo(TypeProfile::class);
    }

    protected function favStyles(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value)
        );
    }

    protected function favBrands(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value)
        );
    }
}
