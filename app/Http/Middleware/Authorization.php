<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseFormatter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!JWTAuth::parseToken()->authenticate()) {
                return ResponseFormatter::error([], 'User not found', Response::HTTP_UNAUTHORIZED);
            }
        } catch (TokenExpiredException $e) {
            if ($request->routeIs('auth.refresh')) return $next($request);
            return ResponseFormatter::error('Token Expired', Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return ResponseFormatter::error('Token Invalid', Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return ResponseFormatter::error($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
