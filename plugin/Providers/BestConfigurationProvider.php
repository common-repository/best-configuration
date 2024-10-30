<?php

namespace BestConfiguration\Providers;

use BestConfiguration\WPBones\Support\ServiceProvider;

class BestConfigurationProvider extends ServiceProvider
{
    protected $options;
    protected $isAdmin = false;

    public function register()
    {
        add_action('best_configuration_options_updated', [ $this, 'best_configuration_options_updated' ]);

        $this->best_configuration_options_updated();
    }

    public function best_configuration_options_updated()
    {
        BestConfigurationManager::boot();
    }

}
