<!-- === GALLERY === -->

<?php $photo_gallery = $block['gallery']; ?>
<div class="strata gallery">
    <div class="container-fluid">
        <div class="gallery">
            <div class="row">
                <?php foreach($photo_gallery as $photo): ?>
                    <div class="col-md-4 col-xs-6">
                        <div class="gallery-item">
                            <a rel="photo-gallery" href="<?php echo $photo['url']; ?>" class="swipebox">
                                <div class="image" style="background-image: url(<?php echo $photo['sizes']['sm']; ?>);">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/transparent_16x9.png">
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
