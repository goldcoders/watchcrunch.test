<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepositories implements UserInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function chunkTopUsers(int $postCount = 10, int $chunkCount = 1000)
    {
        $today    = date('Ymd');
        $cacheKey = md5('optimized' . $today . ':' . $postCount . ':' . $chunkCount);
        $minutes  = 60;
        return Cache::remember($cacheKey, $minutes, function () use ($postCount, $chunkCount) {
            $topPosts = collect();
            $this->queryTopUsers($postCount)
                 ->chunk($chunkCount, function ($users) use ($topPosts) {
                     foreach ($users as $user) {
                         $topPosts->push($user);
                     }
                 });
            return $topPosts->toJson();
        });
    }

    public function find(int $id): Model
    {
        return User::findOrFail($id);
    }

    public function findByName(string $name): ?Model
    {
        return User::findByName($name);
    }

    public function getTopUser($postCount = 10): Builder
    {
        return $this->queryTopUsers($postCount);
    }

    protected function queryTopUsers(int $postCount): Builder
    {
        return User::query()
            ->topPoster($postCount)
            ->latestpost();
    }
}
