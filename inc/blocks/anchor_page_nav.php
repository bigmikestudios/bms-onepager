<?php
$blocks = get_field('blocks');
$titles = array();

foreach($blocks as $my_block) {
    if ($my_block['acf_fc_layout'] == "anchor") {
        $titles[] = $my_block['title'];
    }
}
if (count($titles) > 0) {
?>
<ul class="block-anchor-nav">
    <?php foreach($titles as $title): ?>
        <li><a href="#block-anchor-<?php echo sanitize_title($title); ?>"><?php echo $title; ?></a></li>
    <?php endforeach; ?>
</ul>
<?php

}