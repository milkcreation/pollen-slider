<?php

declare(strict_types=1);

namespace Pollen\Slider;

use Pollen\Slider\Partial\SliderPartial;
use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Concerns\ConfigBagAwareTrait;
use Pollen\Support\Concerns\ResourcesAwareTrait;
use Pollen\Support\Exception\ManagerRuntimeException;
use Pollen\Support\Proxy\ContainerProxy;
use Pollen\Support\Proxy\PartialProxy;
use Psr\Container\ContainerInterface as Container;

class SliderManager implements SliderManagerInterface
{
    use BootableTrait;
    use ConfigBagAwareTrait;
    use ContainerProxy;
    use PartialProxy;
    use ResourcesAwareTrait;

    /**
     * Slider manager main instance.
     * @var SliderManagerInterface|null
     */
    private static ?SliderManagerInterface $instance = null;

    /**
     * @param array $config
     * @param Container|null $container
     */
    public function __construct(array $config = [], ?Container $container = null)
    {
        $this->setConfig($config);

        if ($container !== null) {
            $this->setContainer($container);
        }

        $this->setResourcesBaseDir(dirname(__DIR__) . '/resources');

        $this->boot();

        if (!self::$instance instanceof static) {
            self::$instance = $this;
        }
    }

    /**
     * Retrieve slider main instance.
     *
     * @return static
     */
    public static function getInstance(): SliderManagerInterface
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        throw new ManagerRuntimeException(sprintf('Unavailable [%s] instance', __CLASS__));
    }

    /**
     * @inheritDoc
     */
    public function boot(): SliderManagerInterface
    {
        if (!$this->isBooted()) {
            $this->partial()->register(
                'slider',
                $this->containerHas(SliderPartial::class)
                    ? SliderPartial::class : new SliderPartial($this, $this->partial())
            );

            $this->setBooted();
        }
        return $this;
    }
}