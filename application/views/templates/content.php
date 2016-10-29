<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Section content -->
<?php foreach($section->result() as $section): ?>
    
    <?php 

    $sid            = $section->section_id;
    $section_name   = $section->section_name;
    $section_layout = $section->section_layout;
    
    $auto_height = $section->auto_height;
    if($auto_height == '1')
    { 
        $class_section =  "section-auto"; 
    } 
    else 
    { 
        $class_section = "section-normal"; 
    }

    $layout = $section->section_layout;
    if(($layout == '31') OR ($layout == '32') OR ($layout == '33'))
    { 
        $class_gallery_section      = "section-gallery"; 
        $class_gallery_container    = "container-gallery";
        $class_gallery_row          = "row-gallery";
    }
    else
    {
        $class_gallery_section      = "";
        $class_gallery_container    = "";
        $class_gallery_row          = "";
    }

    if($section->display_menu == '1')
    { 
        $number++; 
        $data_scroll_index =  'data-scroll-index="'.$number.'"'; 
    }
    else
    {
        $data_scroll_index = '';
    }

    $section_bgimage = $section->bgimage;
    if(!empty($section_bgimage) && ($use_bgimage == '1'))
    {
        $bgimage = 'background-image:url('.base_url().''.$section_bgimage.'); background-size:cover';
    } 
    else
    {
        $bgimage = '';
    }

    $section_bgcolor = $section->bgcolor;
    if(!empty($section_bgcolor) && ($use_bgcolor == '1'))
    {
        $bgcolor = 'background-color:'.$section_bgcolor.'';
    }
    else
    {
        $bgcolor = '';
    }

    $section_va = $section->vertical_align;
    if($section_va == '1')
    {
        $class_va_container = "vertical-align";
    }
    else
    {
        $class_va_container = "";
    }

    ?>
    
    <?php if($sid): ?>

        <!-- Section -->
        <div class="section <?php echo $class_section; ?> <?php echo $class_gallery_section; ?>" id="<?php echo $section_name; ?>" 
        <?php echo $data_scroll_index; ?> style="<?php echo $bgcolor; ?>; <?php echo $bgimage; ?>">
            
            <!-- Container -->
            <div class="container <?php echo $class_gallery_container; ?> <?php echo $class_va_container; ?>">
                
                <!-- Row -->
                <div class="row content-center <?php echo $class_gallery_row ?>">

                    <!-- IF section layout 1 column -->
                    <?php if($section_layout == '1'): ?>

                        <!-- show content -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
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
                        <!-- /. -->

                    <!-- IF section layout 2 column -->
                    <?php elseif($section_layout == '2'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                        <?php echo htmlspecialchars_decode($content->content_text);?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout 3 column -->
                    <?php elseif($section_layout == '3'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-4 col-md-4">
                                    <?php if($content->display_title_content == '1'):?>
                                        <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                                            <?php echo $content->content_title;?>
                                        </h3>
                                    <?php endif;?>
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive content-thumbnail center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                        <?php echo htmlspecialchars_decode($content->content_text);?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout 4 column -->
                    <?php elseif($section_layout == '4'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-3 col-md-3">
                                    <?php if($content->display_title_content == '1'):?>
                                        <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                                            <?php echo $content->content_title;?>
                                        </h3>
                                    <?php endif;?>
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                        <?php echo htmlspecialchars_decode($content->content_text);?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout 5 column -->
                    <?php elseif($section_layout == '5'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-1 col-md-1"></div>
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
                                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                        <?php echo htmlspecialchars_decode($content->content_text);?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="col-lg-1 col-md-1"></div>
                        <!-- /. -->

                    <!-- IF section layout 6 column -->
                    <?php elseif($section_layout == '6'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
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
                                    <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                        <?php echo htmlspecialchars_decode($content->content_text);?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout left image -->
                    <?php elseif($section_layout == '21'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-6 col-md-6">
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                </div>
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
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout right image -->
                    <?php elseif($section_layout == '22'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
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

                    <!-- IF section layout gallery 2 column -->
                    <?php elseif($section_layout == '31'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-6 col-md-6 col-gallery">
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block img-gallery <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="content-gallery">
                                        <?php if($content->display_title_content == '1'):?>
                                            <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                                                <?php echo $content->content_title;?>
                                            </h3>
                                        <?php endif;?>
                                        <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                            <?php echo htmlspecialchars_decode($content->content_text);?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout gallery 3 column -->
                    <?php elseif($section_layout == '32'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-4 col-md-4 col-gallery">
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block img-gallery <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="content-gallery">
                                        <?php if($content->display_title_content == '1'):?>
                                            <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                                                <?php echo $content->content_title;?>
                                            </h3>
                                        <?php endif;?>
                                        <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                            <?php echo htmlspecialchars_decode($content->content_text);?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <!-- IF section layout gallery 4 column -->
                    <?php elseif($section_layout == '33'): ?>

                        <!-- show its ontent by section_id -->
                        <div class="col-lg-12 col-md-12">
                            <?php if($section->display_title == '1'):?>
                                <?php foreach($content_list->result() as $content): ?>
                                    <?php if($content->section_id === $sid): ?>
                                        <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                        <?php if($use_tinymce == 0): ?>
                                            <h1 class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></h1>
                                        <?php else: ?>
                                            <div class="<?php echo $wow;?> <?php echo $content->animate;?>"><?php echo htmlspecialchars_decode($content->title); ?></div>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php foreach($content_list->result() as $content): ?>
                            <?php if($content->section_id === $sid): ?>
                                <?php if($content->animation_repeat == '1'){$wow = 'wow';}else{$wow = 'wow_static';}?>
                                <div class="col-lg-3 col-md-3 col-gallery">
                                    <?php if(!empty($content->content_image)): ?>
                                        <img class="img-responsive center-block img-gallery <?php echo $wow;?> <?php echo $content->animate;?>" 
                                        src="<?php echo base_url();?><?php echo $content->content_image;?>">
                                    <?php endif; ?>
                                    <div class="content-gallery">
                                        <?php if($content->display_title_content == '1'):?>
                                            <h3 class="center <?php echo $wow;?> <?php echo $content->animate;?>">
                                                <?php echo $content->content_title;?>
                                            </h3>
                                        <?php endif;?>
                                        <div class="<?php echo $wow;?> <?php echo $content->animate;?>">
                                            <?php echo htmlspecialchars_decode($content->content_text);?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- /. -->

                    <?php endif; ?>
                    <!-- END of IF section layout-->

                </div>
            </div>
        </div>
    <?php endif;?>
<?php endforeach;?>


<a href="#" class="scrollToTop">
    <i class="fa fa-angle-double-up"></i>
</a>