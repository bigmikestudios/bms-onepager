<?php
foreach($block['columns'] as $row):

    $classes = array();

    if (isset($row['large_desktop_column_width']))
        if (intval($row['large_desktop_column_width']) > 0)
            $classes[] = "col-lg-".$row['large_desktop_column_width'];

    if (isset($row['desktop_column_width']))
        if (intval($row['desktop_column_width']) > 0)
            $classes[] = "col-md-".$row['desktop_column_width'];

    if (isset($row['tablet_column_width']))
        if (intval($row['tablet_desktop_column_width']) > 0)
            $classes[] = "col-sm-".$row['tablet_column_width'];

    if (isset($row['phone_column_width']))
        if (intval($row['phone_column_width']) > 0)
            $classes[] = "col-xs-".$row['phone_column_width'];


    ?>


    <div class="<?php echo implode(' ', $classes); ?>">
        <h1><?php echo implode(' ', $classes); ?></h1>
        <?php echo apply_filters('the_content', $row['content']); ?>
    </div>

<?php endforeach; ?>


<?php
//trace($block);