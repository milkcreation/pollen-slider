<?php
/**
 * @var Pollen\Partial\PartialTemplateInterface $this
 */

?>
<?php foreach ($this->get('bullets') as $i)  : ?>
    <button class="glide__bullet" data-glide-dir="=<?php echo $i; ?>"></button>
<?php endforeach; ?>