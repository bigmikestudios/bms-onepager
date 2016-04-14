<?php
$columns = count($block['columns']);
$column_number = 12 / $columns;
?>
<?php foreach ($block['columns'] as $column): ?>

    <div class="col-md-<?php echo $column_number; ?>">
        <?php echo apply_filters('the_content', $column['content']); ?>
    </div>
<?php endforeach; ?>
