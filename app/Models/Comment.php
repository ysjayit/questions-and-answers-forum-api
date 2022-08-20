<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'comment', 'date',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * Get the post associated with the comment.
     */
    public function post()
    {
        return $this->hasOne(Post::class);
    }

    /**
     * Get the user for the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
