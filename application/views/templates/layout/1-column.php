<?php foreach($content_list->result() as $content): ?>
    <?php if($content->section_id === $sid): ?>
        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
        <div class="col-lg-12 col-md-12">
            <?php if($content->display_title_content == '1'):?>
                <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                    <?php echo $content->content_title;?>
                </h3>
            <?php endif;?>
            <?php if(!empty($content->content_image)): ?>
                <img class="img-responsive center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                src="<?php echo base_url();?><?php echo $content->content_image;?>">
            <?php endif; ?>
            <div id="wow" class="<?php echo $wow;?> <?php echo $content->animate;?>">
                <?php echo htmlspecialchars_decode($content->content_text);?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>