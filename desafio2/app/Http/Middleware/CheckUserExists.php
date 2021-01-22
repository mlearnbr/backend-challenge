<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\NotificationHelper;
use App\Models\User;

class CheckUserExists
{
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        $user = User::find($id);

        if ($user) {
            return $next($request);
        } else {
            NotificationHelper::sendNotification(
                'error',
                'Este usuário não existe em nosso banco de dados.'
            );

            return redirect('users');
        }
    }
}
