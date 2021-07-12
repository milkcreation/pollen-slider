<?php

declare(strict_types=1);

namespace Pollen\Slider;

use Pollen\Container\BootableServiceProvider;
use Pollen\Partial\PartialManagerInterface;
use Pollen\Slider\Partial\SliderPartial;

class SliderServiceProvider extends BootableServiceProvider
{
    protected $provides = [
        SliderManagerInterface::class,
        SliderPartial::class
    ];

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        if ($this->getContainer()->has(PartialManagerInterface::class)) {
            $this->getContainer()->get(SliderManagerInterface::class);
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(SliderManagerInterface::class, function () {
            return new SliderManager([], $this->getContainer());
        });

        $this->getContainer()->add(SliderPartial::class, function () {
            return new SliderPartial(
                $this->getContainer()->get(SliderManagerInterface::class),
                $this->getContainer()->get(PartialManagerInterface::class)
            );
        });
    }
}