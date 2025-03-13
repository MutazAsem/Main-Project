<?php

namespace Travelx\School;

use Illuminate\Support\ServiceProvider;

class SchoolServiceProvider extends ServiceProvider
{
    public function register()
    {
        // تسجيل الإعدادات أو أي خدمات أخرى هنا
        $this->mergeConfigFrom(__DIR__ . '/../src/config/config.php', 'school');
    }

    public function boot()
    {
        // تحميل ملفات التهيئة
        $this->publishes([
            __DIR__ . '/../src/config/config.php' => config_path('school.php'),
        ], 'config');

        // نشر الملفات العامة (CSS, JS, Images)
        $this->publishes([
            __DIR__ . '/../src/resources/assets' => public_path('vendor/school'),
        ], 'school-assets');

        // تحميل المسارات
        $this->loadRoutesFrom(__DIR__ . '/../src/routes/web.php');

        // تحميل الـ Views
        $this->loadViewsFrom(__DIR__ . '/../src/resources/views', 'school');

        // تحميل الـ Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');
    }
}
