<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Comment extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [ 'slug', 'description','image_path', 'post_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()  {
        return $this->belongsTo(Post::class);
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
