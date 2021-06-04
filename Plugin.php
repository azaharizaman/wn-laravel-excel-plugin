<?php namespace AzahariZaman\Excel;

use App;
use Event;
use Config;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;

/**
 * Excel Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Ensure plugin runs on command line too
     */
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'azaharizaman.excel::plugin.name',
            'description' => 'azaharizaman.excel::plugin.description',
            'author'      => 'Azahari Zaman',
            'icon'        => 'icon-file-excel-o',
            'homepage'    => 'https://github.com/azaharizaman/wn-laravel-excel-plugin',
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Setup required packages
        $this->bootPackages();

    }

    /**
     * Boots (configures and registers) any packages found within this plugin's packages.load configuration value
     *
     * @see https://luketowers.ca/blog/how-to-use-laravel-packages-in-october-plugins
     * @author Luke Towers <wintercms@luketowers.ca>
     */
    public function bootPackages()
    {
        // Get the namespace of the current plugin to use in accessing the Config of the plugin
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));

        // Instantiate the AliasLoader for any aliases that will be loaded
        $aliasLoader = AliasLoader::getInstance();

        // Locate the packages to boot
        $packages = Config::get($pluginNamespace . '::config.packages');

        // Boot each package
        foreach ($packages as $name => $options) {
            // Setup the configuration for the package, pulling from this plugin's config
            if (!empty($options['config']) && !empty($options['config_namespace'])) {
                Config::set($options['config_namespace'], $options['config']);
            }

            // Register any Service Providers for the package
            if (!empty($options['providers'])) {
                foreach ($options['providers'] as $provider) {
                    App::register($provider);
                }
            }

            // Register any Aliases for the package
            if (!empty($options['aliases'])) {
                foreach ($options['aliases'] as $alias => $path) {
                    $aliasLoader->alias($alias, $path);
                }
            }
        }
    }

}
