<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
    ];

    public static function findByName(string $username)
    {
        return static::query()
            ->where('username', $username)
            ->firstOrFail();
    }

    public static function last()
    {
        return self::latest()->first();
    }

    public function lastPost()
    {
        return $this->belongsTo(Post::class, 'last_post_title');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeLatestpost($query)
    {
        return $query->addSelect(['last_post_title' => function ($query) {
            $query->select('title')
                  ->from('posts')
                  ->whereColumn('user_id', 'users.id')
                  ->orderBy('posts.id', 'desc')
                  ->limit(1);
        }]);
    }

    public static function scopeTopPoster($query, $count)
    {
        return $query->selectRaw('users.username, count(posts.id) as total_posts_count')
                     ->join('posts', 'posts.user_id', '=', 'users.id')
                     ->groupBy('posts.user_id', 'users.username', 'users.id')
                     ->havingRaw('COUNT(posts.id) >= ?', [$count])
                     ->orderBy('total_posts_count', 'desc');
    }
}
