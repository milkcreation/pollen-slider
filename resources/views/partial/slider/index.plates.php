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

        <?php if ($this->get('arrows')) : ?>
            <div class="glide__arrows" data-glide-el="controls">
                <?php $this->insert('arrows', $this->all()); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->get('bullets')) : ?>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                <?php $this->insert('bullets', $this->all()); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->get('controls')) : ?>
            <div data-glide-el="controls">
                <?php $this->insert('controls', $this->all()); ?>
            </div>
        <?php endif; ?>
    </div>

<?php $this->after();