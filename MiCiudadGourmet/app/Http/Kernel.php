protected $middleware = [
    // ...
    \Illuminate\Http\Middleware\HandleCors::class,   // ← ¡debe estar!
    \App\Http\Middleware\TrustProxies::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    // ...
];
