<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuditService;

class AuditLogMiddleware
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $this->auditService->log($request);
        }

        return $next($request);
    }
}

