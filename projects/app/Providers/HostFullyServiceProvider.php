<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\HostFully;

/**
 * Class HelperServiceProvider
 * @package App\Providers
 */
class HostFullyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('HostFully', function()
        {
            return new HostFully;
        });
    }
}
