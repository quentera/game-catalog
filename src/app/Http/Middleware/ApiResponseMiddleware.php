<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\DataProtectService;
class ApiResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $isEncryptionEnabled = config('dataprotect.encrypts_response_data');

        if (!$isEncryptionEnabled) {
            return $response;
        }

        // Try to extract data from the response (if it's JSON)
        $originalContent = method_exists($response, 'getData')
            ? $response->getData(true) 
            : json_decode($response->getContent(), true);

        if (is_null($originalContent)) {
            return $response;
        }

        $protector = app(DataProtectService::class);
        $encryptedData = $protector->encryptData($originalContent);

        return response()->json([
            'data' => $encryptedData,
        ], $response->getStatusCode());
    }

}
