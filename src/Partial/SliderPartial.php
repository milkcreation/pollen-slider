<?php

declare(strict_types=1);

namespace Pollen\Slider\Partial;

use Pollen\Partial\PartialDriver;
use Pollen\Partial\PartialManagerInterface;
use Pollen\Slider\SliderManagerInterface;
use Pollen\Validation\Validator as v;

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
    public function defaultParams(): array
    {
        return array_merge(
            parent::defaultParams(),
            [
                /**
                 * @var bool
                 */
                'arrows' => false,

                /**
                 * @var bool
                 */
                'bullets' => false,

                /**
                 * @var array|bool
                 */
                'controls' => false,

                /**
                 * List of slides.
                 * @var string[]|callable[]
                 * @see https://picsum.photos/images
                 */
                'slides'  => [
                    'https://picsum.photos/800/800/?image=768',
                    'https://picsum.photos/800/800/?image=669',
                    'https://picsum.photos/800/800/?image=646',
                    'https://picsum.photos/800/800/?image=883',
                ],
                /**
                 * List of engine options
                 * @var array $options
                 */
                'options' => [],
                /**
                 * DOM Mutation observer indicator.
                 * @var bool
                 */
                'observe' => true,
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $slides = $this->get('slides', []);
        foreach ($slides as &$slide) {
            if (is_callable($slide)) {
                $slide = $slide();
            } elseif (is_array($slide)) {
                continue;
            } elseif (v::url()->validate($slide)) {
                $slide = "<img src=\"$slide\" alt=\"\"/>";
            }
        }
        unset($slide);

        $this->set(
            [
                'slides'             => $slides,
                'attrs.data-options' => $this->get('options', []),
            ]
        );

        if ($this->get('bullets')) {
            $this->set('bullets', array_keys(array_values($slides ?: [])));
        }

        if ($controls = $this->get('controls')) {
            $defaultControls = [
                'first' => 'First',
                'last'  => 'Last',
                'page'  => true,
                'next'  => 'Next',
                'prev'  => 'Prev'
            ];

            $controls = !is_array($controls) ? $defaultControls : array_merge($defaultControls, $controls);

            if ($controls['page']) {
                $controls['total'] = count($slides);
            }

            $this->set('controls', $controls);
        }

        if ($this->get('observe')) {
            $this->set('attrs.data-observe', 'slider');
        }

        return parent::render();
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->sliderManager->resources('views/partial/slider');
    }
}