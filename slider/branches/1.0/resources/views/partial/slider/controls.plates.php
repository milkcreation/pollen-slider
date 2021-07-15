<?php
/**
 * @var Pollen\Partial\PartialTemplateInterface $this
 */

?>
<?php if ($first = $this->get('controls.first', 'First')) : ?>
    <button data-glide-dir="<<"><?php echo $first; ?></button>
<?php endif; ?>

<?php if ($prev = $this->get('controls.prev', 'Prev')) : ?>
    <button data-glide-dir="<"><?php echo $prev; ?></button>
<?php endif; ?>

<?php if ($this->get('controls.page', 'Next')) : ?>
    Page: <span class="glide__page_current">1</span>/<span class="glide__page_total"><?php echo $this->get('controls.total'); ?></span>
<?php endif; ?>

<?php if ($next = $this->get('controls.next', 'Next')) : ?>
    <button data-glide-dir=">"><?php echo $next; ?></button>
<?php endif; ?>

<?php if ($last = $this->get('controls.last', 'Last')) : ?>
    <button data-glide-dir=">>"><?php echo $last; ?></button>
<?php endif; ?>
