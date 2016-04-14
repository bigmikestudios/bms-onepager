<div class="col-sm-12">
    <?php echo apply_filters('the_content', $block['description']); ?>
</div>
<div class="col-sm-12 col-md-8 col-md-offset-2">
    <?php foreach ($block['images'] as $image): ?>
    <?php $image_url = $image['image']['url']; ?>
    <?php $link_url = $image['url']; ?>
    <?php $open_in_a_new_tab = $image['open_in_a_new_tab']; ?>
    <div class="col-sm-3">
        <?php if ($image['url']) :?>
        <a href="<?php echo $image['url'];?>"
           <?php if ($image['open_in_a_new_tab']): ?>target="_blank"<?php endif; ?>>

            <img src="<?php echo $image_url; ?>" class="img-responsive center-block" alt='' />
        </a>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>

</div>