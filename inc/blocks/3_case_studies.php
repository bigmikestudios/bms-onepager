<?php

$cases = get_posts(array(
    "post_type" => "case_study",
    "posts_per_page" => 3,
));

$colsize = 12/count($cases);

?>

<?php foreach ($cases as $case): ?>
    <div class="col-md-<?php echo $colsize; ?>">
        <?php if (has_post_thumbnail($case->ID)): ?>
            <?php echo image_div(get_post_thumbnail_url($case->ID)); ?>
        <?php endif; ?>
        <h3><a href="<?php echo get_permalink($case->ID); ?>" ><?php echo $case->post_title; ?></a></h3>
        <?php echo apply_filters('the_content', $case->post_content); ?>
        <p><?php echo do_shortcode("[button url='".get_permalink($case->ID)."' label='Read More']"); ?></p>
    </div>
<?php endforeach; ?>