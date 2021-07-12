<?php

declare(strict_types=1);

namespace Pollen\Slider;

use Pollen\Support\Concerns\BootableTraitInterface;
use Pollen\Support\Concerns\ConfigBagAwareTraitInterface;
use Pollen\Support\Concerns\ResourcesAwareTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;
use Pollen\Support\Proxy\PartialProxyInterface;

interface SliderManagerInterface extends
    BootableTraitInterface,
    ConfigBagAwareTraitInterface,
    ContainerProxyInterface,
    PartialProxyInterface,
    ResourcesAwareTraitInterface
{
    /**
     * Booting.
     *
     * @return SliderManagerInterface
     */
    public function boot(): SliderManagerInterface;
}