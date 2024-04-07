<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user.profile'];

    protected $fillable = ['user_id', 'main_comment', 'image', 'style_id'];

    protected $appends = ['first_image'];

    protected $casts = [
        'assets' => 'array'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function getFirstImageAttribute()
    {
        return $this->getFirstMediaUrl();
    }

    public function garments()
    {
        return $this->belongsToMany(Garment::class);

    }

    public function garmentsString()
    {
        return $this->garments->map(fn (Garment $garment) => $garment->name)->join(', ');
    }

    public function postUserScores()
    {
        return $this->hasMany(PostUserScore::class);
    }
}
