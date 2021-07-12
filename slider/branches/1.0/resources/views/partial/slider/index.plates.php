<?php
/**
 * @var Pollen\Partial\PartialTemplateInterface $this
 */
?>
<?php $this->before(); ?>
    <div <?php $this->attrs(); ?>>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
            <?php foreach ($this->get('slides', []) as $slide) : ?>
                <li class="glide__slide">
                    <?php $this->insert('slide', compact('slide')); ?>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php $this->after();