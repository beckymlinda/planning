<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditService
{
    public function log(Request $request, $model = null, $action = null)
    {
        $user = auth()->user();
        
        if (!$user) {
            return;
        }

        $action = $action ?? $this->detectAction($request);
        
        AuditLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'old_values' => $model && method_exists($model, 'getOriginal') ? $model->getOriginal() : null,
            'new_values' => $model ? $model->getAttributes() : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    protected function detectAction(Request $request)
    {
        $method = $request->method();
        $path = $request->path();

        return match(true) {
            $method === 'POST' => 'create',
            $method === 'PUT' || $method === 'PATCH' => 'update',
            $method === 'DELETE' => 'delete',
            $method === 'GET' && str_contains($path, 'dashboard') => 'view_dashboard',
            default => 'view',
        };
    }
}

