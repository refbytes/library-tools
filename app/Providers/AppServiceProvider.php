<?php

namespace App\Providers;

use App\Http\ViewComposers\LayoutViewComposer;
use App\Http\ViewComposers\SubscriptionsViewComposer;
use App\Models\User;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Scramble::ignoreDefaultRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            'layouts.*',
            LayoutViewComposer::class
        );
        View::composer(
            [
                'layouts.*',
                'livewire.subscriptions',
                'components.subscriptions.*',
            ],
            SubscriptionsViewComposer::class
        );

        Gate::before(function (User $user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        Gate::define('viewApiDocs', function (User $user) {
            return $user->hasRole('admin') ? true : null;
        });

        Scramble::registerApi('v1', [
            'api_path' => 'api/v1',
            'info' => ['version' => '1.0.0'],
        ])
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/v1/');
            })
            ->afterOpenApiGenerated(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('saml2', \SocialiteProviders\Saml2\Provider::class);
        });

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());
        // Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
    }
}
