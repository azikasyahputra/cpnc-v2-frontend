<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Thin HTTP client for the CPNC API project (sibling Laravel 13 app).
 *
 * Every call authenticates with the Bearer token stored in the session by
 * LoginController after /auth/login. Responses are decoded JSON.
 */
class ApiClient
{
    /**
     * Base URL of the API, e.g. http://127.0.0.1:8001/api
     */
    public static function baseUrl(): string
    {
        return rtrim((string) env('API_BASE_URL', 'http://127.0.0.1:8001/api'), '/');
    }

    /**
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected static function request()
    {
        $http = Http::baseUrl(static::baseUrl())
            ->acceptJson()
            ->timeout(60);

        if ($token = session('api_token')) {
            $http->withToken($token);
        }

        return $http;
    }

    public static function get(string $path, array $params = [])
    {
        return static::handle(static::request()->get(ltrim($path, '/'), $params), $path);
    }

    public static function post(string $path, array $data = [])
    {
        return static::handle(static::request()->post(ltrim($path, '/'), $data), $path);
    }

    public static function put(string $path, array $data = [])
    {
        return static::handle(static::request()->put(ltrim($path, '/'), $data), $path);
    }

    public static function delete(string $path)
    {
        return static::handle(static::request()->delete(ltrim($path, '/')), $path);
    }

    /**
     * @param  \Illuminate\Http\Client\Response  $response
     * @return mixed
     */
    protected static function handle($response, string $path)
    {
        if ($response->status() === 401) {
            throw new ApiUnauthorizedException('API token tidak valid.');
        }

        if ($response->failed()) {
            $message = $response->json('message') ?? "HTTP {$response->status()}";
            throw new RuntimeException("API error pada {$path}: {$message}");
        }

        return $response->json();
    }
}
