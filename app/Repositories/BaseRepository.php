<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

abstract class BaseRepository
{
    protected function getFromCacheOrSave(string $key, callable $callback, ?int $ttl = null): mixed
    {
        return Cache::remember($key, $ttl ?? 3600, $callback);
    }

    protected function getFromCache(string $key): mixed
    {
        return Cache::get($key);
    }
}
