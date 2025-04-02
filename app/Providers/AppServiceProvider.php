<?php

namespace App\Providers;

use App\Models\Standard;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Criterion;

use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
       
    }


    public function boot(): void
    {
        Relation::morphMap([
            'main' => \App\Models\MainStandard::class,
            'sub' => \App\Models\SubStandard::class,
        ]);
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $counts = [
                'all' => Standard::count(), // Total standards
                'completed' => Standard::where('completion_status', 'completed')->count(),
                'partially_completed' => Standard::where('completion_status', 'partially_completed')->count(),
                'incomplete' => Standard::where('completion_status', 'incomplete')->count(),
                'criteria_all' => Criterion::count(),
                'criteria_matching' => Criterion::where('is_met', true)->count(),
                'criteria_non_matching' => Criterion::where('is_met', false)->count(),
            ];
            $view->with('counts', $counts);
        });
    
    }
    
}
