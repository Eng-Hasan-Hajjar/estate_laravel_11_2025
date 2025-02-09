<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;  // تأكد من أن هذا السطر موجود
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{

 
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
