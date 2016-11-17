<!-- show content -->
<?php foreach($content as $content): ?>
<?php if($content['section_id'] === $sid): ?>
<div class="col-lg-2 col-md-2">
    <?php if($content['display_title_content'] == '1'):?>
        <h3 class="center <?php echo $content['wow'];?> <?php echo $content['animate'];?>">
            <?php echo $content['content_title'];?>
        </h3>
    <?php endif;?>
    <?php if(!empty($content['content_image'])): ?>
        <img class="img-responsive center-block <?php echo $content['wow'];?> <?php echo $content['animate'];?>" src="<?php echo base_url();?><?php echo $content['content_image'];?>">
    <?php endif; ?>
    <?php if(!empty($content['content_text'])): ?>
        <div id="wow" class="<?php echo $content['wow'];?> <?php echo $content['animate'];?>">
            <?php echo $content['content_text'];?>
        </div>
    <?php endif; ?>
</div> 
<?php endif; ?>
<?php endforeach; ?>
<!-- /. -->
