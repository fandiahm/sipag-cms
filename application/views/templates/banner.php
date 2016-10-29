<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Banner section -->
<div class="carousel-section" data-scroll-index="0">
    <div id="owl-banner" class="owl-carousel owl-theme">
        <?php if($banner_display == 1): ?>
            <?php foreach($banner_item->result() as $row): ?>
                <?php if(!empty($row->image)):?>
                    <div class="item" style="background-image: 
                    url(<?php echo base_url();?><?php echo $row->image;?>)">
                        <!-- here if you wanna using as image just delete style above and uncomment tag below -->
                        <!--img src="<?php //echo base_url();?>assets/uploads/banner/<?php //echo $row->image;?>"-->
                        <div class="caption">
                            <?php if($banner_display_header == 1): ?>
                                <h3><?php echo $row->header;?></h3>
                            <?php endif; ?>
                            <?php if($banner_display_caption == 1): ?>
                                <h1><?php echo $row->caption;?></h1>
                            <?php endif; ?>
                            <?php if($banner_display_button == 1): ?>
                                <a data-scroll-nav="1" class="btn btn-primary btn-carousel">
                                    <i class="fa fa-angle-double-down"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>