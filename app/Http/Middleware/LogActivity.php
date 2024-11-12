<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    protected $statusCodes;

    public function __construct()
    {
        $this->statusCodes = include base_path('app/Helpers/StatusCodes.php');
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $sanitizedData = $this->sanitizeRequestData($request->all());

        $authRoutes = ['post-login', 'logout'];

        $currentRoute = $request->route()->uri();

        if (in_array($currentRoute, $authRoutes)) {
            $user = Auth::user();
            $log = new ActivityLog();
            $log->user_id = $user ? $user->id : null;
            $log->action = $request->method();
            $log->description = $request->fullUrl();
            $log->ip_address = $request->ip();
            $log->user_agent = $request->header('User-Agent');
            $log->referer_url = $request->header('Referer');
            $log->status_code = $response->status();
            $log->status_description = $this->statusCodes[$response->status()] ?? 'Unknown Status';
            $log->request_data = json_encode($sanitizedData);
            $log->save();
        } // elseif ($request->method() !== 'GET') {
        $user = Auth::user();
        $log = new ActivityLog();
        $log->user_id = $user ? $user->id : null;
        $log->action = $request->method();
        $log->description = $request->fullUrl();
        $log->ip_address = $request->ip();
        $log->user_agent = $request->header('User-Agent');
        $log->referer_url = $request->header('Referer');
        $log->status_code = $response->status();
        $log->status_description = $this->statusCodes[$response->status()] ?? 'Unknown Status';
        // $log->request_data = json_encode($request->all());
        $log->request_data = json_encode($sanitizedData);
        $log->save();
        // }

        return $response;
    }

    protected function sanitizeRequestData(array $data)
    {
        unset($data['password']);
        // unset($data['password_confirmation']);
        // unset($data['konfirmasi_password']);
        unset($data['_token']);

        return $data;
    }
}
