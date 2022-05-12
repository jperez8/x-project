<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user.profile'];

    protected $fillable = ['user_id', 'main_comment', 'image'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_link'];

    public function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset("storage/$this->image"),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
