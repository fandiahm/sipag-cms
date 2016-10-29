<div class="col-lg-12 col-md-12">
    <?php if($section->display_title == '1'):?>
        <?php foreach($content_list->result() as $content): ?>
            <?php if($content->section_id === $sid): ?>
                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                <?php if($use_tinymce == 0): ?>
                    <h1 class="page-header <?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                <?php else: ?>
                    <span class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></span>
                <?php endif; ?>
            <?php break; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php foreach($content_list->result() as $content): ?>
    <?php if($content->section_id === $sid): ?>
        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
        <div class="col-lg-2 col-md-2">
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