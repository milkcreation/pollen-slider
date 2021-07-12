<?php

declare(strict_types=1);

namespace Pollen\Slider\Partial;

use Pollen\Partial\PartialDriver;
use Pollen\Partial\PartialManagerInterface;
use Pollen\Slider\SliderManagerInterface;

class SliderPartial extends PartialDriver
{
    /**
     * Slider Manager instance.
     * @var SliderManagerInterface|null
     */
    protected ?SliderManagerInterface $sliderManager = null;

    /**
     * @param SliderManagerInterface $sliderManager
     * @param PartialManagerInterface $partialManager
     */
    public function __construct(SliderManagerInterface $sliderManager, PartialManagerInterface $partialManager)
    {
        $this->sliderManager = $sliderManager;

        parent::__construct($partialManager);
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->sliderManager->resources('views/partial/slider');
    }
}