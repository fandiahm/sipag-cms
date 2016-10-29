
        <div class="col-lg-4 col-md-4">
            <?php foreach($content_list->result() as $content): ?>
                <?php if($content->display_title_content == '1'):?>
                    <h3 class="center wow <?php echo $content->animate;?>">
                        <?php echo $content->content_title;?>
                    </h3>
                <?php endif;?>
                <?php if(!empty($content->content_image)): ?>
                    <img class="img-responsive center-block wow <?php echo $content->animate;?>" 
                    src="<?php echo base_url();?><?php echo $content->content_image;?>">
                <?php endif; ?>
                <div id="wow" class="wow <?php echo $content->animate;?>">
                    <?php echo htmlspecialchars_decode($content->content_text);?>
                </div>
            <?php endforeach; ?>
        </div>