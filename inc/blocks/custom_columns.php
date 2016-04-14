<?php
$columns = count($block['columns']);
$column_number = 12 / $columns;
?>
<?php foreach ($block['columns'] as $column): ?>
    <?php
    $column_class = "";
    if ($column['width'])   $column_class .= " col-md-".$column['width']." ";
    if ($column['offset'])  $column_class .= " col-md-offset-".$column['offset']." ";
    if ($column['push'])    $column_class .= " col-md-push-".$column['push']." ";
    if ($column['pull'])    $column_class .= " col-md-pull-".$column['pull']." ";
    ?>
    <div class="<?php echo $column_class; ?>">
        <?php if ($column['wrapper_class']): ?><div class="<?php echo $column['wrapper_class'];?>"><?php endif;?>
            <?php echo apply_filters('the_content', $column['content']); ?>
        <?php if ($column['wrapper_class']): ?></div><?php endif; ?>
    </div>
<?php endforeach; ?>