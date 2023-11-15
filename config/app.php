<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use SocialBrothers\DI\Config\ContainerConfig;
use SocialBrothers\Interop\ServiceProviderInterface;

return ContainerConfig::create()
    ->withProviders(
        /**
         * Plugin Providers.
         *
         * @var array<class-string|ServiceProviderInterface> $providers
         *
         * @see ServiceProviderInterface
         */
        []
    )
    ->withDefinitions(
        /**
         * Factory Definitions.
         *
         * @var array<string, callable|Closure> $definitions
         *
         * @see ContainerInterface
         */
        []
    );
