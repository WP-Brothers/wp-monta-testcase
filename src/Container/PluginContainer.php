<?php

declare(strict_types=1);

namespace SocialBrothers\MontaTestcase\Container;

use DI\ContainerBuilder;
use LogicException;
use Psr\Container\ContainerInterface;
use ReflectionException;
use SocialBrothers\DI\Builder\Builder;
use SocialBrothers\DI\BuilderInterface;
use SocialBrothers\DI\ContainerConfigInterface;
use SocialBrothers\DI\ContainerProxyTrait;
use SocialBrothers\Interop\ServiceProviderInterface;
use function collect;
use function dirname;
use function is_string;

/**
 * @implements ContainerInterface
 */
final class PluginContainer implements ContainerInterface
{
    use ContainerProxyTrait;

    private static ?self $instance = null;

    private ContainerInterface $container;

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function getInnerContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @throws ReflectionException
     */
    private function getBuilder(): BuilderInterface
    {
        if (isset($this->container)) {
            throw new LogicException('The Builder should only be used for initial Container bootstrapping.');
        }

        return new Builder(function (ContainerConfigInterface $config): ContainerInterface {
            return (new ContainerBuilder())
                ->addDefinitions(
                    collect($config->getProviders())
                        ->map(
                            function (ServiceProviderInterface|string $provider): iterable {
                                if (is_string($provider)) {
                                    $provider = new $provider();
                                }

                                return $provider->getFactories();
                            }
                        )
                        ->add($config->getDefinitions())
                        ->collapse()
                        ->toArray()
                )
                ->build();
        });
    }

    private function getConfig(): ContainerConfigInterface
    {
        return (static function (): ContainerConfigInterface {
            return include dirname(__FILE__, 3) . '/config/app.php';
        })();
    }

    /**
     * @throws ReflectionException
     */
    private function __construct()
    {
        $this->container = ($this->getBuilder())($this->getConfig());
    }
}
