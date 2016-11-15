<!-- section title -->
<div class="col-lg-12 col-md-12">
    <?php if($display_title_section == '1'): ?>
    <?php   if($use_tinymce == 0): ?>
        <h1 class="<?php echo $wow;?> <?php echo $animate;?>"><?php echo $section_title; ?></h1>
    <?php   else: ?>
        <div class="<?php echo $wow;?> <?php echo $animate;?>"><?php echo $section_title; ?></div>
    <?php   endif; ?>
    <?php endif; ?>
</div>
<!-- /section title -->

<!-- show content -->
<?php foreach($content as $content): ?>
<?php if($content['section_id'] === $sid): ?>
<div class="col-lg-4 col-md-4">
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
