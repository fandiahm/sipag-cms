<!-- show its ontent by section_id -->
<div class="col-lg-12 col-md-12">
    <?php foreach($content_list->result() as $content): ?>
        <?php if($content->display_title == '1'):?>
            <?php if($content->section_id === $sid): ?>
                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                <?php if($use_tinymce == 0): ?>
                    <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                <?php else: ?>
                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                <?php endif; ?>
            <?php break; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php foreach($content_list->result() as $content): ?>
    <?php if($content->section_id === $sid): ?>
        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
        <div class="col-lg-6 col-md-6">
            <?php if($content->display_title_content == '1'):?>
                <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                    <?php echo $content->content_title;?>
                </h3>
            <?php endif;?>
            <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                <?php echo htmlspecialchars_decode($content->content_text);?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <?php if(!empty($content->content_image)): ?>
                <img class="img-responsive center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                src="<?php echo base_url();?><?php echo $content->content_image;?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<!-- /. -->