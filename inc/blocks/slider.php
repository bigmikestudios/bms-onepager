<div class="col-md-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $active="active"; $i=0; foreach($block['slides'] as $slide): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; $active=""; ?>"></li>
                <?php $i++; endforeach; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php $active="active"; $i=0; foreach($block['slides'] as $slide): ?>
                <div class="item <?php echo $active; $active=""; ?>">
                    <?php echo image_div($slide['image']['ID'], "12x5"); ?>
                    <div class="carousel-caption">
                        <?php if ($slide['title']): ?>
                            <h2><?php echo $slide['title']; ?></h2>
                        <?php endif; ?>
                        <?php if ($slide['content']): ?>
                            <?php echo apply_filters('the_content', $slide['content']); ?>
                        <?php endif; ?>
                        <?php if ($slide['button_url'] ): ?>
                            <?php
                            $sc = "[button ";
                            $sc.= "href='".$slide['button_url']."' ";
                            if ($slide['button_label']) $sc.= " label='".$slide['button_label']."' ";
                            if ($slide['open_in_a_new_tab']) $sc.= " new='true'";
                            $sc.= "]";
                            ?>
                            <?php echo  do_shortcode($sc); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> </div>

    <!-- preload -->
    <script type="text/javascript">
        jQuery([<?php
            $imgs = array();
            foreach($block['slides'] as $slide ){
                $imgs[]="'".$slide['image']['sizes']['lg']."'";
            }
            echo implode(',', $imgs);
            ?>]).preload();
    </script>

</div>