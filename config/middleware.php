<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware تُطبق على مسارات محددة باستخدام المجموعات في ملفات
    | routes/web.php أو routes/api.php. يُمكنك تسجيل Middleware هنا واستخدامها
    | عبر المسارات.
    |
    */
/*
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
*/
    /*
    |--------------------------------------------------------------------------
    | Global Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware يمكن تطبيقها على مستوى المشروع بالكامل (في كل الطلبات).
    | إذا كان لديك Middleware عالمي، يمكنك تسجيله هنا.
    |
    */

    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    /*
    |--------------------------------------------------------------------------
    | Middleware Groups
    |--------------------------------------------------------------------------
    |
    | مجموعات من Middleware يمكن تطبيقها معًا. على سبيل المثال، يمكنك
    | إنشاء مجموعة `web` أو `api` التي تجمع بين Middleware متعددة.
    |
    */

    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
];