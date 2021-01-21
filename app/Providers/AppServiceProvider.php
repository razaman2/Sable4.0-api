<?php

    namespace App\Providers;

    use Helpers\ADC\ADCAuth;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\ServiceProvider;
    use Laravel\Telescope\TelescopeServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         * @return void
         */
        public function register() {
            $this->app->bind(ADCAuth::class, function() {
                return new ADCAuth(request()->input('credentials.username', env('ADC_USERNAME')), request()->input('credentials.password', env('ADC_PASSWORD')), request()->input('credentials.branchID', 0), request()->input('credentials.twoFactor', ''));
            });

            $this->app->bind(Docusign::class, function() {
                return new Docusign(request()->input('test') ? DocusignAuthFactory::authenticate([
                    'Username' => env('DOCUSIGN_DEV_USERNAME'),
                    'Password' => env('DOCUSIGN_DEV_PASSWORD'),
                    'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
                ])->setHost(env('DOCUSIGN_DEV_HOST')) :

                    DocusignAuthFactory::authenticate(request()->input('auth'))->setHost(env('DOCUSIGN_PRO_HOST')));
            });

            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        /**
         * Bootstrap any application services.
         * @return void
         */
        public function boot() {
            if(env('APP_ENV') !== 'local') {
                URL::forceScheme('https');
            }
        }
    }
