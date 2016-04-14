<?php ob_start(); // Picture side ?>
    <img src="<?php echo $block['image']['sizes']['medium']; ?>"/>
<?php $image_side = ob_get_clean(); ?>

<?php ob_start(); // Text Side ?>
    <h3>
        <?php if ($block['icon']): ?>
        <span class="icon"><?php image_div($block['icon']['url'], "square"); ?></span>
        <?php endif; ?>
        <?php echo $block['title']; ?>
    </h3>
    <?php echo apply_filters('the_content', $block['text']); ?>
<?php $text_side = ob_get_clean(); ?>

<?php if ($block['image_side'] == 'Left') : ?>
<div class="col-md-4"><?php echo $image_side; ?></div>
<div class="col-md-8"><?php echo $text_side; ?></div>
<?php else: ?>
<div class="col-md-4 col-md-push-8"><?php echo $image_side; ?></div>
<div class="col-md-8 col-md-pull-4"><?php echo $text_side; ?></div>
<?php endif; ?>