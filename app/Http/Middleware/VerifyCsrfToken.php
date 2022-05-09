<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/admin/dashboard/volunteers/suspend',
        '/admin/dashboard/volunteers/suspend/stop',
        '/volunteer/review',
        '/volunteer/badge',
        '/volunteer/complaint',
        '/organization/dashboard/activity/end',
        '/volunteer/activity/email/send',
    ];
}
