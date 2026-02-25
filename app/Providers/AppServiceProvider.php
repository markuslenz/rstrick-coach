<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        Inertia::share('permission', fn () => [
            'isAdmin' => auth()->user()?->isAdmin(),
            'canEdit' => auth()->user()?->canEdit(),
        ]);

        Inertia::share([
            'locale' => fn () => app()->getLocale(),
            'locales' => ['de', 'en'],
            'translations' => function () {
                $locales = ['de', 'en'];
                $translations = [];

                foreach ($locales as $locale) {
                    $files = File::files(lang_path($locale));

                    foreach ($files as $file) {
                        $name = pathinfo($file, PATHINFO_FILENAME);
                        $translations[$locale][$name] = trans($name, [], $locale);
                    }
                }

                return $translations;
            },
        ]);
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }
}
