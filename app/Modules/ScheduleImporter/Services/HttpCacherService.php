<?php

namespace App\Modules\ScheduleImporter\Services;

use Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class HttpCacherService
{
    public function get(string $url, array|null $params = [], array $headers = []): Collection
    {
        $cacheKey = $this->getCacheKey($url, $params);
        $data = Cache::remember(
            $cacheKey,
            config('cache.memory_ttl_seconds'),
            static function () use ($params, $url, $headers) {
                $query = Http::withHeaders($headers);
                $body = ($params ? $query->get($url, $params) : $query->get($url))->body();
                $body = utf8_encode($body);
                return json_decode(substr($body, strpos($body, '{')), true, 512, JSON_THROW_ON_ERROR);
            }
        );

        return collect($data ?? []);
    }

    private function getCacheKey(string $url, ?array $params): string
    {
        return sprintf('3http-cacher-%s-%s', $url, json_encode($params) ?? '');
    }
}
