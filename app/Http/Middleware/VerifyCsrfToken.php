<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    protected $except = [
        '/student/hardware/come_school',
        '/student/hardware/leave_school',

        '/login',
        '/professor/scores/store/excel/export',
        '/professor/scores/store/excel/import'
    ];

}
