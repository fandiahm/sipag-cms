<!-- show content -->
<div class="col-lg-12 col-md-12">
    <div class="carousel-<?php echo $sid; ?>">
    <?php foreach($content as $content): ?>
    <?php   if($content['section_id'] === $sid): ?>
        <div class="item">
            <?php if($content['display_title_content'] == '1'):?>
                <h3 class="center <?php echo $content['wow'];?> <?php echo $content['animate'];?>">
                    <?php echo $content['content_title'];?>
                </h3>
            <?php endif;?>
            <?php if(!empty($content['content_image'])): ?>
                <img class="img-responsive center-block <?php echo $content['wow'];?> <?php echo $content['animate'];?>" src="<?php echo base_url();?><?php echo $content['content_image'];?>">
            <?php endif; ?>
            <?php if(!empty($content['content_text'])): ?>
            <div class="center" id="wow" class="<?php echo $content['wow'];?> <?php echo $content['animate'];?>">
                <?php echo $content['content_text'];?>
            </div>
            <?php endif; ?>
        </div>
    <?php   endif; ?>
    <?php endforeach; ?>
    </div>
</div>
<!-- /. -->

<script>jQuery(function($){var name_class='.carousel-<?php echo $sid; ?>';$(name_class).owlCarousel({loop:true,margin:10,nav:true,responsive:{0:{items:1},600:{items:3},1000:{items:5}}});});</script>
