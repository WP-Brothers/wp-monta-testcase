<?php

declare(strict_types=1);

namespace SocialBrothers\MontaTestcase\Helpers;

use SocialBrothers\MontaTestcase\Container\PluginContainer;

/**
* Retrieve a binding from the Plugin's main Container.
*
* @param class-string $id
*
* @phpstan-param string|class-string $id
* @phpstan-param string|class-string $id
*
* @throws ContainerExceptionInterface
* @throws NotFoundExceptionInterface
*
* @see          PluginContainer
* @see          ContainerInterface
*
* @noinspection PhpUnhandledExceptionInspection
*/
function service(string $id): mixed
{
  return PluginContainer::getInstance()->get($id);
}
