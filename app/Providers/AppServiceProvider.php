<?php

namespace App\Providers;

use App\Models\ContactDetail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share contact details globally (footer + contact page) without breaking if migrations not yet run
        View::composer(['layouts.footer', 'layouts.app', 'contact.index'], function ($view) {
            try {
                if (Schema::hasTable('contact_details')) {
                    $contactDetail = ContactDetail::singleton();
                    $view->with('contactDetail', $contactDetail);
                    // Also share as global for any view that wants it
                    View::share('globalContactDetail', $contactDetail);
                }
            } catch (\Throwable $e) {
                // silently ignore during migrate / install
            }
        });
    }
}
