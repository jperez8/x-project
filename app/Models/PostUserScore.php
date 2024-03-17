<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUserScore extends Model
{
    use HasFactory;

    protected $table = 'post_user_score';

    protected $fillable = ['user_id', 'post_id', 'score'];
}
